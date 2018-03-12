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



-- Customer
create table Customers(
    custName VARCHAR(25) NOT NULL,
    phoneNo NUMERIC(10) PRIMARY KEY
);

-- Service Contract
-- attribute of contract type?
create table ServiceContract(
    contractID VARCHAR(5) PRIMARY KEY,
    startDate date NOT NULL,
    endDate date NOT NULL,
    phoneNo NUMERIC(10),
    compID VARCHAR(5),
    printID VARCHAR(5)
    foreign key (phoneNo) references Customers(phoneNo)
);

create table RepairItems(
    itemID VARCHAR(5) PRIMARY KEY,
    machineID VARCHAR(5),
    model 
);