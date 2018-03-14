-- Initialize tables
-- System is built for employees to input data

-- cost of parts should be a separate thing upon input

-- ProblemCode(problemCode, description)
 
-- Prices(parts,price)

-- An entry for each item, where machineId serves as an id for that specific machine
-- RepairItems(machineId, model, price, year, serviceContractType)

-- ServiceContract(contractId, startDate, endDate, customerInfo, machineId1, machineId2)

-- RepairJob(machineId, contractId, arrivalTime, ownerInfo, status)

-- RepairPerson(employeeNo, employeeName, phoneNo)

-- CustomerBill(machineId, model, customerName, custPhoneNo, arrivalTime, timeOut, problemCodes, repair-personId, laborHours, partsUsedCost, totalCost)


-- Customer(custName, phoneNo)
create table Customers(
    custFirst VARCHAR(15) NOT NULL,
    custLast VARCHAR(15) NOT NULL,
    phoneNo NUMERIC(10) PRIMARY KEY
);


-- Repair Items(machineID, model, price, phoneNo, serviceContractType)
create table RepairItems(
    machineID VARCHAR(5) PRIMARY KEY,
    model VARCHAR(15),
    price NUMERIC(7,2),
    phoneNo NUMERIC(10),
    serviceContractType VARCHAR(15) CHECK (serviceContractType = 'SINGLE' OR serviceContractType = 'GROUP' OR serviceContractType = 'NONE'),
    foreign key (phoneNo) references Customers(phoneNo)
);


-- Service Contract(contractID, startDate, endDate, machienID, machineID2, phoneNo)
create table ServiceContract(
    contractID VARCHAR(5) PRIMARY KEY,
    startDate date NOT NULL,
    endDate date NOT NULL,
    machineID VARCHAR(5) NOT NULL,
    machineID2 VARCHAR(5),
    phoneNo NUMERIC(10),
    #contract is either single or group
    serviceContractType VARCHAR(15) CHECK (serviceContractType = 'SINGLE' OR serviceContractType = 'GROUP'),
    foreign key (phoneNo) references Customers(phoneNo)
);

-- Repair Job(machineID, contractID, arrivalTime, ownerInfo, jobstat)
-- DATE FORMAT: DD-MON-YYYY
-- ex: select to_char(sysdate, 'DD-Mon-YYYY HH24:MI') as "Current Time" from dual;
create table RepairJob(
    machineID VARCHAR(5),
    contractID VARCHAR(5),
    arrivalTime TIMESTAMP, 
    ownerInfo NUMERIC(10), 
    jobstat VARCHAR(15) CHECK (jobstat = 'UNDER_REPAIR' OR jobstat = 'READY' OR jobstat = 'DONE'),
    foreign key (machineID) references RepairItems(machineID),
    foreign key (contractID) references ServiceContract(contractID),
    foreign key (ownerInfo) references Customers(phoneNo)
);

-- Repair Employee
create table RepairPerson(
    employeeNo VARCHAR(5) PRIMARY KEY,
    employeeFirst VARCHAR(15) NOT NULL,
    employeeLast VARCHAR(15) NOT NULL,
    phoneNo NUMERIC(10) UNIQUE
);

-- Problem Code
-- contains descriptions of problem codes
create table ProblemCode(
    problemCode VARCHAR(5) PRIMARY KEY,
    description VARCHAR(20),
);

-- Problem Report
-- Weak Entity depends on RepairJob
create table ProblemReport(
    problemCode VARCHAR(5),
    arrivalTime DATE,
    ownerInfo NUMERIC(10),
    PRIMARY KEY(problemCode, arrivalTime, ownerInfo)
);


-- Customer Bill
-- CustomerBill(machineId, model, customerName, custPhoneNo, arrivalTime, timeOut, problemCodes, repair_personId, laborHours, partsUsedCost, totalCost)
-- References most of its content from other tables
create table CustomerBill(
    machineId VARCHAR(5), 
    model VARCHAR(15), 
    customerName VARCHAR(25), 
    custPhoneNo NUMERIC(10), 
    arrivalTime DATE, 
    timeOut DATE, 
    #single problem for now
    problemCodes VARCHAR(5), 
    repair_personID VARCHAR(5), 
    laborHours NUMERIC(3,2), 
    partsUsedCost NUMERIC(5,2), 
    totalCost NUMERIC(5,2),
    foreign key (machineID) references RepairID(machineID),
    foreign key (model) references RepairItems(model),
    foreign key (customerName) references Customers(customerName),
    foreign key (custPhoneNo) references Customers(phoneNo),
    foreign key (arrivalTime) references RepairJob(arrivalTime),
    foreign key (problemCodes) references ProblemReport(problemCode),
    foreign key (repair_personID) references RepairPerson(employeeNo),
    foreign key (partsUsedCost) references RepairItems(price)
);
