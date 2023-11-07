# Очищаем данные
DELETE FROM category;
DELETE FROM user;
DELETE FROM lot;
DELETE FROM rate;

# Очищаем автоинкременты
ALTER TABLE category AUTO_INCREMENT = 0;
ALTER TABLE user AUTO_INCREMENT = 0;
ALTER TABLE lot AUTO_INCREMENT = 0;
ALTER TABLE rate AUTO_INCREMENT = 0;

# Заполняем категории
INSERT INTO category(name, symbol_code)
VALUES ("Доски и лыжи", "boards"),
       ("Крепления", "attachment"),
       ("Ботинки", "boots"),
       ("Одежда", "clothing"),
       ("Инструменты", "tools"),
       ("Разное", "other");



# Заполняем пользователей
INSERT INTO user(email, name, password, contacts)
VALUES ("tema.levin@gmail.com", "Artem Levin", "leo506", "qwe"),
       ("misha.anokhin@gmail.com", "Misha Anohin","microliit", "ewq"),
       ("stepa.kosulin@gmail.com", "Stepa Kosulin", "stepa", "123");



# Заполняем лоты
INSERT INTO lot(name, description, image, start_price, end_date, rate_step, author_id, winner_id, category)
VALUES ("2014 Rossignol District Snowboard", "cool", "img/lot-1.jpg", 10999, "2023-09-11", 100, 1, NULL, 1),
       ("DC Ply Mens 2016/2017 Snowboard", "cool", "img/lot-2.jpg", 159999, "2023-09-13", 100, 2, NULL, 1),
       ("Крепления Union Contact Pro 2015 года размер L/XL", "cool", "img/lot-3.jpg", 8000, "2023-09-14",100, 3, NULL, 2),
       ("Ботинки для сноуборда DC Mutiny Charocal", "cool", "img/lot-4.jpg", 10999,"2023-09-15", 100, 1, NULL, 3),
       ("Куртка для сноуборда DC Mutiny Charocal", "cool", "img/lot-5.jpg", 7500, "2023-09-16", 100, 2, NULL, 4),
       ("Маска Oakley Canopy", "cool", "img/lot-6.jpg", 5400,"2023-09-17", 100, 3, NULL, 6);



# Заполняем ставки
INSERT INTO rate(self_price, user_id, lot_id)
VALUES  (12000, 2, 1),
        (15000, 1, 3);


# Выбрать все категории
SELECT * FROM category;

# Получить cписок лотов, которые еще не истекли отсортированных по дате публикации, от новых к старым.
# Каждый лот должен включать название, стартовую цену, ссылку на изображение, название категории и дату окончания торгов;
SELECT lot.name, lot.start_price, lot.image, lot.end_date, lot.create_at, category.name AS category FROM lot
JOIN category ON category.id = lot.category
WHERE lot.end_date >= CURRENT_DATE
ORDER BY lot.create_at DESC;

# Показать информацию о лоте по его ID. Вместо id категории должно выводиться  название категории, к которой принадлежит лот из таблицы категорий;
SELECT *, category.name AS category FROM lot AS l
JOIN category ON category.id = l.id
WHERE l.id = 1;

# Обновить название лота по его идентификатору;
UPDATE lot
SET name = "Куртка Мишута"
WHERE lot.id = 6;

# Получить список ставок для лота по его идентификатору с сортировкой по дате.
# Список должен содержать дату и время размещения ставки, цену, по которой пользователь готов приобрести лот, название лота и имя пользователя, сделавшего ставку
SELECT r.create_at, r.self_price, lot.name AS lot_name, user.name AS user_name FROM rate AS r
JOIN lot ON lot.id = r.lot_id
JOIN user ON user.id = r.user_id
WHERE r.id = 1
ORDER BY r.create_at DESC;













