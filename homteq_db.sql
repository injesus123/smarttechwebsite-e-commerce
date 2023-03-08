DROP TABLE IF EXISTS Product;
CREATE TABLE Product (
prodId INT AUTO_INCREMENT,
prodName VARCHAR(200) NOT NULL,
prodPicNameSmall VARCHAR(200) NOT NULL,
prodPicNameLarge VARCHAR(200) NOT NULL,
prodDescripShort VARCHAR(1000) ,
prodDescripLong VARCHAR(2000) ,
prodPrice DECIMAL(8,2) NOT NULL DEFAULT '0.00',
prodQuantity INT NOT NULL DEFAULT '100',
CONSTRAINT p_pid_pk PRIMARY KEY (prodId)
);

INSERT INTO Product
(prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity)
VALUES
('HIVE Active Heating Thermostat', 'hivesmall.jpg', 'hivebig.jpg',
'Hive Active Heating connects you and your heating system via an app on your mobile device to give you convenient
control over operating times from wherever you are.',
'With an all-new wall-mounted thermostat control unit, Hive Active Heating looks great and can reduce the heating
bills in any home. With control from your mobile, laptop or tablet, you\'ll never need to heat an empty home again.
Up to six heating events can be scheduled throughout the day, so you can wake up in comfort, cut the heating while
the house is empty and return to a comfortable home after a long day at work. ',
145.00, 35),
('Samsung QE85QN900B Neo QLED','samsungtvsmall.jpg','samsungtvbig.jpg',
'Samsung QE85QN900B  Neo QLED HDR 4000 8K Ultra HD Smart TV 85 inch with TVPlus Freesat HD & Dolby Atmos, Bright Silver',
'Take a step into awe-inspiring, next-level detail on an expansive 8K screen. 
Lose yourself in, and get more out of the latest blockbusters, binge TV, and 
the brilliant best of the gaming world. Experience Samsung\'s ultimate 2022 TV, 
immersing yourself  the depth of Neo QLED 8K resolution 
 breath-taking audio,  their flagship QN900B TV. See a True 8K HDR picture 
 an Infinity Screen,  ultimate blacks, perfect colour,  superb surround sound thanks  Dolby Atmos tech.', 5145.00, 45),
 ('Samsung Jet Bot AI+ Robot Vacuum Cleaner, Misty White','jetbotaismall.jpg','jetbotaibig.jpg',
 'The 3D Sensor precisely scans the space  detect possible obstructions.',
 'The LiDAR Sensor accurately tracks the Jetbot\’s  help it moves efficiently  
 increase the ground coverage, ensuring you clean more of your home.',989.00,56 ),
 ('Apple HomePod mini Smart Speaker, Space Grey','Applehomepodsmall.jpg','Applehomepodbig.jpg',
 'The Apple HomePod mini delivers an unexpectedly large sound for a speaker of its size',
 'Standing not even 10cm tall, the HomePod mini is able to fill the entire room with rich, 
 360º audio that’s ready to immerse your senses from every angle.', 99.00,50),
 ('Google Nest Cam with Floodlight Outdoor Security Camera, Wired, White','Googlenestcamsmall.jpg','Googlenestcambig.jpg',
 'Google Nest Cam makes sure that your home safely enabling you  keeps an eye  things, even  you are outside.',
 'The Google Home app  your smart device you can recieve  alerts  taken actions. 
 This camera features a floodlight that you can customise, weather resistance, powered  a wired connection.',269.00,30);


DROP TABLE IF EXISTS Users;
CREATE TABLE Users (
userId INT AUTO_INCREMENT,
userType VARCHAR(1) NOT NULL,
userFName VARCHAR(100) NOT NULL,
userSName VARCHAR(100) NOT NULL,
userAddress VARCHAR(200) NOT NULL,
userPostCode VARCHAR(20) NOT NULL,
userTelNo VARCHAR(20) NOT NULL,
userEmail VARCHAR(100) NOT NULL UNIQUE,
userPassword VARCHAR(100) NOT NULL,
CONSTRAINT u_uid_pk PRIMARY KEY (userId)
) ;
 

 INSERT INTO
Users
(userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword)
VALUES
('A', 'Luke', 'Skywalker', '23 Tatooine Road, Brighton', 'BN1 2CD', '02079115001', 'ls@jedi.com', '?skyw@lk!'),
('C', 'Darth', 'Vader', '23 Death Star Road, Bath', 'BA4 1KD', '02079115002', 'dv@sith.com', 'vad3r!D@rth'),
('C', 'Leia', 'Organa', '23 Alderaan Street, London', 'NW4 6RF', '02079115003', 'lo@princess.com', '?l3i@!');


CREATE TABLE Orders (
    orderNo INT PRIMARY KEY AUTO_INCREMENT,
    userId INT NOT NULL,
    orderDateTime DATETIME NOT NULL,
    orderTotal DECIMAL(8,2) NOT NULL DEFAULT '0.00',
    orderStatus VARCHAR(50) NOT NULL,
    shippingDate DATETIME NOT NULL,
    CONSTRAINT o_uid_fk FOREIGN KEY (userId)
        REFERENCES Users(userId) ON DELETE CASCADE
);









DROP TABLE IF EXISTS Order_Line;
CREATE TABLE Order_Line (
    orderLineId INT PRIMARY KEY AUTO_INCREMENT,
    orderNo INT NOT NULL,
    prodId INT NOT NULL,
    quantityOrdered DATETIME NOT NULL,
    orderTotal DECIMAL(8,2) NOT NULL DEFAULT '0.00',
    CONSTRAINT o_olid_fk FOREIGN KEY (orderNo)
        REFERENCES Orders(orderNo) ON DELETE CASCADE
);