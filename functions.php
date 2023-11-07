<?php

function get_categories(mysqli $con): array {
    $sql = "SELECT * FROM category;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        $error = mysqli_error($con);
        print("Ошибка MySQL: " . $error);
        return [];
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);

}

function get_lots(mysqli $con): array {
    $sql = "SELECT lot.id, lot.name, lot.start_price, lot.image, lot.end_date, lot.create_at, category.name AS category FROM lot
            JOIN category ON category.id = lot.category
            WHERE lot.end_date >= CURRENT_DATE
            ORDER BY lot.create_at DESC;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        $error = mysqli_error($con);
        print("Ошибка MySQL: " . $error);
        return [];
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_lot_by_id(mysqli $con, int $id): array {
    $sql = "SELECT lot.id, lot.name, lot.start_price, lot.image, lot.end_date, lot.create_at, lot.description, lot.rate_step, lot.author_id, category.name AS category FROM lot
            JOIN category ON category.id = lot.category
            WHERE lot.id = (?);";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_array($result, MYSQLI_ASSOC) ?? http_response_code(404);
}

function get_category_id_by_name(mysqli $con, string $name): array {
    $sql = "SELECT id FROM category WHERE category.name = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function add_new_lot(mysqli $con, string $name, string $description, string $image, int $start_price, string $end_date, int $rate_step, int $author_id, int $category): int {
    $sql = "INSERT INTO lot(name, description, image, start_price, end_date, rate_step, author_id, winner_id, category)
             VALUES (?, ?, ?, ?, ?, ?, ?, NULL, ?)";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssisiii", $name, $description, $image, $start_price, $end_date, $rate_step, $author_id, $category);
    mysqli_stmt_execute($stmt);
    return get_last_lot_id($con)[0];
}

function get_last_lot_id(mysqli $con): array {
    $sql = "SELECT id FROM lot ORDER BY id DESC";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_row($result);
}

function create_new_user(mysqli $con, string $email, string $password, string $name, string $contacts) {
    $sql = "INSERT INTO user(email, password, name, contacts)
            VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $email, $password, $name, $contacts);
    mysqli_stmt_execute($stmt);
}

function find_user_by_email(mysqli $con, string $email): array {
    $sql = "SELECT * FROM user WHERE user.email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function find_user_by_id(mysqli $con, int $id): array {
    $sql = "SELECT * FROM user WHERE user.id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function find_lots_by_text(mysqli $con, string $text, int $offset, int $limit): array {
    $sql = "SELECT lot.id, lot.name, lot.start_price, lot.image, lot.end_date, lot.create_at, category.name AS category FROM lot
            JOIN category ON category.id = lot.category
            WHERE lot.end_date >= CURRENT_DATE AND MATCH(lot.name, lot.description) AGAINST(?)
            ORDER BY lot.create_at DESC
            LIMIT ?
            OFFSET ?;";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'sii', $text, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function count_lots_by_text(mysqli $con, string $text): string {
    $sql = "SELECT COUNT(*) FROM lot WHERE MATCH(lot.name, lot.description) AGAINST(?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $text);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_row($result)[0];
}

function get_count_lots_by_category_id(mysqli $con, int $category_id): int {
    $sql = "SELECT COUNT(*) FROM lot
            JOIN category ON category.id = lot.category
            WHERE lot.end_date >= CURRENT_DATE AND category.id = (?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_row($result)[0];
}

function get_lots_by_category_id(mysqli $con, int $category_id, int $limit, int $offset): array {
    $sql = "SELECT lot.id, lot.name, lot.start_price, lot.image, lot.end_date, lot.create_at, category.name AS category FROM lot
            JOIN category ON category.id = lot.category
            WHERE lot.end_date >= CURRENT_DATE AND category.id = (?)
            ORDER BY lot.create_at DESC
            LIMIT ?
            OFFSET ?;";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $category_id, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_bets_for_lot_by_id(mysqli $con, int $id): array {
    $sql = "SELECT rate.self_price, rate.create_at, user.id as id, user.name as user FROM `rate` JOIN user ON user.id = rate.user_id WHERE rate.lot_id = ? ORDER BY rate.self_price DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function create_new_rate(mysqli $con, int $user_id, int $lot_id, int $self_price): void {
    $sql = 'INSERT INTO rate(user_id, lot_id, self_price)
            VALUES (?, ?, ?)';

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $user_id, $lot_id, $self_price);
    mysqli_stmt_execute($stmt);
}

function get_bets_by_user_id(mysqli $con, int $user_id): array {
    $sql = "SELECT rate.self_price, rate.create_at, category.name as category, lot.name as name, lot.image as image, lot.winner_id as winner,
            lot.description as description, lot.end_date as date, lot.id as id FROM `rate`
            JOIN lot ON lot.id = rate.lot_id
            JOIN category on lot.category = category.id
            WHERE rate.user_id = ?
            ORDER BY rate.create_at DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_lots_id_where_date_end(mysqli $con): array {
    $sql = "SELECT lot.id FROM lot
            WHERE lot.end_date < CURRENT_DATE";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function set_winner_for_lot(mysqli $con, int $lot_id, int $winner_id): void {
    $sql = "UPDATE lot
            SET lot.winner_id = ?
            WHERE lot.id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $winner_id, $lot_id);
    mysqli_stmt_execute($stmt);
}

