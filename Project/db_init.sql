-- not tested yet
create database SCS;
use SCS;

create table Item(
    ItemID int not null,
    ItemName varchar(65535) not null,
    ItemPrice decimal(10,2) not null,
    MadeIn varchar(255),
    DeptCode int,
    primary key (ItemID)
);

create table User(
    UserID int not null,
    UserName varchar(65535),
    Phone varchar(10), --can be bigger for international
    Email varchar(255) not null,
    UserAddress varchar(65535), --should this be a special type
    CityCode int,
    LoginID varchar(255) not null, --actual username for website?
    PW varchar(255) not null, --hash in php, then store as fixed char(length of hash)
    Balance decimal(10,2),
    primary key (UserID)
);

create table Truck(
    TruckID int not null,
    TruckCode int not null,
    AvailabilityCode int not null,
    primary key (TruckID)
);

create table Shopping(
    ReceiptID int not null,
    StoreCode int not null,
    TotalPrice decimal(10,2) not null,
    primary key (ReceiptID)
);

create table Order( --need foreign keys for other tables ids
    OrderID int not null,
    DateIssued datetime not null, --is datetime overkill
    DateReceived datetime,
    TotalPrice decimal(10,2),
    PaymentCode int, --wtf is payment code
    UserID int not null,
    TripID int,
    ReceiptID int not null,
    primary key (OrderID),
    foreign key (UserID) references User(UserID),
    foreign key (TripID) references Trip(TripID),
    foreign key (ReceiptID) references Shopping(ReceiptID),
    foregin key (TotalPrice) references Shopping(TotalPrice) --not sure abt this
);

create table Trip(
    TripID int not null,
    SourceCode int,
    DestinationCode int,
    Distance decimal(10,2),
    TruckID int,
    TotalPrice decimal(10,2), --technically Price = ItemPrice but doesn't it make more sense for entire order
    primary key (TripID),
    foreign key (TruckID) references Truck(TruckID),
    foreign key (TotalPrice) references Order(TotalPrice) -- Order or Shopping
);
