#1) 4 варианта:
SELECT * FROM Manufacturers LEFT JOIN parts ON Manufacturers.id=parts.man_id WHERE Manufacturers.name IN ('Dell Ltd','JDF Ltd');
SELECT * FROM Manufacturers LEFT JOIN parts ON Manufacturers.id=parts.man_id WHERE Manufacturers.name = 'Dell Ltd' OR Manufacturers.name = 'JDF Ltd';
SELECT Manufacturers.*, parts.* FROM Manufacturers, parts WHERE Manufacturers.id=parts.man_id AND Manufacturers.name IN ('Dell Ltd', 'JDF Ltd');
SELECT Manufacturers.*, parts.* FROM Manufacturers, parts WHERE Manufacturers.id=parts.man_id AND (Manufacturers.name = 'Dell Ltd' OR Manufacturers.name = 'JDF Ltd');

#2) 2 варианта:
SELECT * FROM Manufacturers WHERE NOT EXISTS (SELECT * FROM parts WHERE Manufacturers.id=parts.man_id)
SELECT * FROM Manufacturers WHERE (SELECT COUNT(*) FROM parts WHERE Manufacturers.id=parts.man_id) = 0

#3)
UPDATE Manufacturers INNER JOIN parts ON Manufacturers.id = parts.man_id
SET Manufacturers.id = 5, 
parts.man_id = Manufacturers.id
WHERE Manufacturers.id = 1;

#4)
DELETE Manufacturers, parts FROM Manufacturers INNER JOIN parts ON Manufacturers.id = parts.man_id
WHERE Manufacturers.name = 'JDF Ltd';

#5)
#Следует отказаться от INNER JOIN так как это весьма затратная операция:
SELECT p.name, m.name from parts AS p, Manufacturers AS m WHERE m.id=p.man_id ORDER BY p.name DESC