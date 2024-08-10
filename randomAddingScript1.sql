-- SET @Color = ELT(FLOOR(RAND() * 19 + 1), 'BLACK', 'NAVY', 'SHARK', 'GRAY', 'CHARCOAL', 'GREEN', 'OLIVE', 'MAROON', 'RED', 'WHITE', 'WATERMELON', 'TEAL','PURPLE', 'LILAC', 'IVORY', 'TAN', 'SKY', 'SLATE', 'ORANGE', 'SIENNA');
-- SET @Brand = ELT(FLOOR(RAND() * 5 + 1), 'EG', 'KC', 'CC', 'PU', 'LW', 'CS');

-- INSERT INTO inventory(productID, itemName, itemBrand, itemColor, itemPrice, itemQuantity, itemMaxQuantity)
	-- VALUES((FLOOR(RAND() * (19999999 - 10000000 + 1)) + 10000000), 'Jacket', @Brand, @Color, ROUND(RAND() * (100), 2), (FLOOR(RAND() * (19 - 10 + 1)) + 5), (FLOOR(RAND() * (19 - 10 + 1)) + 25));

-- End of Inventory Query Testing Materials

-- Begin Customer Query Testing Materials
-- SET @FirstName = ELT(FLOOR(RAND() * 22 + 1), 'John','Mark','Luke','Cody','Parker','Angela','Susan','Katie','Sarah','Jake','Josh','Emilia','Kristin','Brandon','Louis','Mario','Frank','George','Phil','Tanya','Lora','Laura','Karen');
-- SET @LastName = ELT(FLOOR(RAND() * 20 + 1), 'Brown','Smith','Green','Clark','Farmer','Potter','Skywalker','Stage','England','France','German','Ester','Sydney','Bell','Edison','Tesla','Musk','Trump','Biden','Harris','Filler');
-- SET @Address = ELT(FLOOR(RAND() * 10 + 1), '123 Rainbow Rd', '203 Greenbrook Dr', '5314 Riverway St', '12 First St', '63452 Hollow Hill Dr','5671 Junior Rd', '123 Gleesdale Blvd','1899 Skoperman Ct', '7542 Flabingo Dr', '56552 Tratago St', '1342 Dingople St');
-- SET @Address2 = ELT(FLOOR(RAND() * 5 + 1), '','Apt 2','Apt 45','Floor 8','','');
-- SET @City = ELT(FLOOR(RAND() * 9 + 1), 'Winchester','Springfield','Middletown','Baltimore','York','Villagehole','Citytopolis','Fillerton','Notrealplace','Place City');
-- SET @State = ELT(FLOOR(RAND() * 4 + 1), 'VA','MD','DE','NY','TX');
-- SET @Zip = ELT(FLOOR(RAND() * 9 + 1), '22602','22532','23563','29505','24566','21113','20002','24451','29994','28742');
-- SET @Phone = CONCAT((FLOOR(100 + RAND() * (999 - 100 + 1))),"-",(FLOOR(100 + RAND() * (999 - 100 + 1))),"-",(FLOOR(1000 + RAND() * (9999 - 1000 + 1))));


-- INSERT INTO customerinfo(customerID, customerFirstName, customerLastName, customerAddress, customerAddress2, customerCity, customerState, customerZipcode, customerPhone)
	-- VALUES((FLOOR(RAND() * (29999999 - 20000000 + 1)) + 20000000), @FirstName, @LastName, @Address, @Address2, @City, @State, @Zip, @Phone);
    
-- End of Customer Query Testing Materials

-- Start of Order Query Testing Materials
-- DROP FUNCTION IF EXISTS generateItems;
/*
DELIMITER $$
CREATE FUNCTION generateItems()
RETURNS VARCHAR(60)
DETERMINISTIC
 BEGIN
DECLARE no INT;
DECLARE max INT;
DECLARE itemToAdd INT;
DECLARE orderList VARCHAR(60);
  SET max = (FLOOR(RAND() * (5 - 1 + 1)) + 1); -- SELECTS RANDOM 1-4 to run the loop through
  SET no = 0;
  SET orderList = "";
  loop_label: LOOP
    SET no = no +1;
    SET itemToAdd = (SELECT productID FROM inventory ORDER BY RAND() LIMIT 1);
    SET orderList = (CONCAT(orderlist, CONVERT(itemToAdd, CHAR(12))," "));
    IF no = max THEN
     LEAVE loop_label;
    END IF;
 END LOOP loop_label;
 RETURN orderList;
END $$
DELIMITER ;


SET @orderID = (FLOOR(RAND() * (39999999 - 30000000 + 1)) + 30000000);
SET @orderCustomer = (SELECT customerID FROM customerInfo ORDER BY RAND() LIMIT 1);
SET @orderItems = generateItems();
SET @orderAddress = (SELECT customerAddress FROM customerInfo WHERE customerID = @orderCustomer);
SET @orderStatus = ELT(FLOOR(RAND() * 4 + 1), 'PENDING', 'SHIPPED', 'CANCELED', 'TRANSIT', 'DELIVERED');

-- INSERT INTO orders(orderID, orderCustomer, orderItems, orderAddress, orderStatus)
	-- VALUES(@orderID, @orderCustomer, @orderItems, @orderAddress, @orderStatus);

SELECT * FROM orders;

*/
-- End of Orders Query Testing Materials

-- Start of Rental Query Testing Materials
/*
SET @itemID = (FLOOR(RAND() * (59999999 - 50000000 + 1)) + 50000000);
SET @brand =  ELT(FLOOR(RAND() * 5 + 1), 'EG', 'KC', 'CC', 'PU', 'LW', 'CS');
SET @itemType = ELT(FLOOR(RAND() * 5 + 1), 'Jacket', 'Pants', 'Vest', 'Shoe', 'Tie', 'Shirt');
SET @itemSize = 0;
SET @quantity = (FLOOR(RAND() * (1000 - 10 + 1)) + 10);

INSERT INTO rentalinventory(itemID, itemBrand, itemType, itemSize, itemQuantity)
	VALUES(@itemID, @brand, @itemType, @itemSize, @quantity);

SELECT * FROM rentalinventory;

*/
SET @orderID = (FLOOR(RAND() * (69999999 - 60000000 + 1)) + 60000000);
SET @Customer = (SELECT customerID FROM customerInfo ORDER BY RAND() LIMIT 1);
SET @orderItems = generateItems();
SET @eventDate = CURRENT_DATE + INTERVAL FLOOR(RAND() * 150) DAY;
SET @returnDate = @eventDate + INTERVAL 1 DAY;
SET @orderStatus = "ORDERED";

DROP FUNCTION IF EXISTS generateItems;

DELIMITER $$
CREATE FUNCTION generateItems()
RETURNS VARCHAR(60)
DETERMINISTIC
 BEGIN
DECLARE no INT;
DECLARE max INT;
DECLARE itemToAdd INT;
DECLARE orderList VARCHAR(60);
  SET max = (FLOOR(RAND() * (5 - 1 + 1)) + 1); -- SELECTS RANDOM 1-4 to run the loop through
  SET no = 0;
  SET orderList = "";
  loop_label: LOOP
    SET no = no +1;
    SET itemToAdd = (SELECT itemID FROM rentalinventory ORDER BY RAND() LIMIT 1);
    SET orderList = (CONCAT(orderlist, CONVERT(itemToAdd, CHAR(12))," "));
    IF no = max THEN
     LEAVE loop_label;
    END IF;
 END LOOP loop_label;
 RETURN orderList;
END $$
DELIMITER ;

INSERT INTO rentalorders(orderID, customerID, orderItems, eventDate, returnDate, orderStatus)
	VALUES(@orderID, @Customer, @orderItems, @eventDate, @returnDate, @orderStatus);
    
SELECT * FROM rentalorders;