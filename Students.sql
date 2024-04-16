CREATE DATABASE CSCI4410;

USE CSCI4410;

CREATE TABLE Students (
    ID int(3),
    Name varchar(50),
    BlueCard int(9),
    Major varchar(50),
    ClassLevel varchar(50),
    Email varchar(50),
    Gender varchar(50),
    Age int(3),
    Phone varchar(50)
);

INSERT INTO Students (ID, Name, BlueCard, Major, ClassLevel, Email, Gender, Age, Phone)
VALUES 
    (1, 'John Doe', 1234567, 'Computer Science', 'Freshman', 'DoeJohn@mtsu.edu', 'Male', 19, '123-456-7890'),
    (2, 'Jane Doe', 7654321, 'Mathematics', 'Senior', 'DoeJane@mtsu.edu', 'Female', 22, NULL),
    (3, 'Mary Mia', 9872345, 'Music', 'Senior', 'MaryMia@mtsu.edu', 'Female', 22, '615-123-3344'),
    (4, 'Michael Jame', 7234589, 'Business', 'Junior', 'MichaelJame@mtsu.edu', 'Male', 20, '615-232-1155'),
    (5, 'Daniel Jack', 4135892, 'Computer Science', 'Sophomore', 'DanielJack@mtsu.edu', 'Male', 19, '615-333-2266'),
    (6, 'Lucy Kate', 72358924, 'Computer Science', 'Freshmen', 'LucyKate@mtsu.edu', 'Female', 18, '976-111-4567'),
    (7, 'Lauren Spade', 5896294, 'Computer Science', 'Senior', 'LaurenSpade@mtsu.edu', 'Female', 22, '756-222-1478'),
    (8, 'Emma Vivian', 67451144, 'Mathematics', 'Sophomore', 'EmmaVivian@mtsu.edu', 'Female', 20, '546-333-7459'),
    (9, 'Ada Lane', 66655544, 'Art', 'Junior', 'AdaLane@mtsu.edu', 'Female', 19, '765-777-2255'),
    (10, 'Alan Parker', 88833322, 'Business', 'Senior', 'AlanParker@mtsu.edu', 'Male', 24, '999-222-5588');
