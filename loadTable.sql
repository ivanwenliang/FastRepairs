-- Insert values into Customers, these are customers with already existing service contracts
insert into Customers values('Ivan','Liang', 5552431021, NULL);
insert into Customers values('Bill','White', 5553657689, NULL);
insert into Customers values('Bob','Hamilton', 5552468753, NULL);
insert into Customers values('Jill','Lee', 5552087968, NULL);
insert into Customers values('Sammie','To', 5552102946, NULL);


-- Insert into Repair Items
-- Repair Items(machineID, model, price, phoneNo, serviceContractType)
insert into RepairItems values('m0001', 'C0001', 50, 5552431021, 'SINGLE');
insert into RepairItems values('m0002', 'C0002', 80, 5553657689, 'SINGLE');
insert into RepairItems values('m0003', 'C0003', 100, 5552468753, 'SINGLE');
insert into RepairItems values('m0004', 'C0004', 80, 5552468753, 'GROUP');
insert into RepairItems values('m0006', 'P0001', 100, 5552468753, 'GROUP');


-- Insert values into Service Contract, for customers defined above
insert into ServiceContract values('S001','12-AUG-2017', '15-SEP-2018', 'm0001', NULL, 5552431021, 'SINGLE');
insert into ServiceContract values('S002','22-JAN-2018', '05-JUN-2018', 'm0002', NULL, 5553657689, 'SINGLE');
insert into ServiceContract values('S003','17-FEB-2017', '15-APR-2018', 'm0003', NULL, 5552468753, 'SINGLE');
insert into ServiceContract values('G001','09-MAR-2017', '15-JUN-2018', 'm0004', 'm0006', 5552087968, 'GROUP');
-- insert into ServiceContract values('G002','10-JUN-2017', '21-DEC-2018', 'P0002', 'C0005', 5552102946, 'GROUP');


-- Insert values into Repair Person
insert into RepairPerson values('e0001', 'Kanye', 'West', 0002224564);
insert into RepairPerson values('e0002', 'Barrack', 'Obama', 0002249567);
insert into RepairPerson values('e0003', 'Snoop', 'Dog', 0002227830);
insert into RepairPerson values('e0004', 'Taylor', 'Swift', 0002229586);
insert into RepairPerson values('e0005', 'James', 'Corden', 00022200791);



-- Insert into Repair Job
-- Repair Job(machineID, machineID2, contractID, arrivalTime, custPhoneNo, jobstat, employeeNo)
insert into RepairJob values('m0001', NULL, 'S001', '12-DEC-2017', 5552431021, 'UNDER_REPAIR', 'e0001');
insert into RepairJob values('m0002', NULL, 'S002', '20-JAN-2018', 5553657689, 'UNDER_REPAIR', 'e0002');
insert into RepairJob values('m0004', 'm0006', 'G001', '02-FEB-2018', 5552468753, 'UNDER_REPAIR', 'e0003');

-- Insert into ProblemCode
insert into ProblemCode values('A01: Battery Replacement');
insert into ProblemCode values('A02: Screen Replacement');
insert into ProblemCode values('A03: Harddrive Replacement');
insert into ProblemCode values('A04: Recover corrupted data');
insert into ProblemCode values('B01: Cartridge Replacement');
insert into ProblemCode values('B02: Printer Part Replacement');



