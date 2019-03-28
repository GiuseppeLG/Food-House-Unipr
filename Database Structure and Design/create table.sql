create table LOCALE
(
  IDLocale numeric(2)  primary key,
  Tipo character(20) not null,
  Nome character(20) not null,
  Indirizzo character(50) not null,
  OrarioA time not null,
  OrarioC time not null
)


create table PRODOTTO
(
  IDProdotto numeric(3)  primary key,
  Nome character(20) not null,
  Prezzo numeric(3) not null,
  Descrizione character(100) not null
)


create table CLIENTE
(
  Username character(10)  primary key,
  Password character(8) not null,
  Nome character(20) not null,
  Cognome character(20) not null,
  Indirizzo character(50) not null,
  Telefono character(10),
  Email character(20)
)


create table BUONOSCONTO
(
  IDBuonoSconto character(10)  primary key,
   Cliente character(6) not null
  	references CLIENTE(IDCliente),
  Valore numeric(1) not null
)


-- Imposto primary key, escludendo importo in quanto sarà la somma dei prezzi singoli di ogni prodotto --
create table ORDINE
(
  IDOrdine character(10),
   Locale numeric(2) 
  	references LOCALE(IDLocale),
 Prodotto numeric(3)
  	references PRODOTTO(IDProdotto),
 Cliente character(10) 
  	references CLIENTE(Username),
  Data date,
   Importo numeric(4) not null,
    primary key (IDOrdine, Locale, Prodotto, Cliente)
)

create table DISTRIBUZIONE
(
  Locale numeric(2) 
  	references LOCALE(IDLocale),
 Prodotto numeric(3) 
  	references PRODOTTO(IDProdotto),
  primary key (Locale, Prodotto)
)