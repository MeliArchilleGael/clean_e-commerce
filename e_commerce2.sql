DROP DATABASE IF EXISTS e_commerce;

CREATE DATABASE IF NOT EXISTS e_commerce;
USE e_commerce;
# -----------------------------------------------------------------------------
#       TABLE : ADDRESSE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ADDRESSE
 (
   ID_ADDRESSE INT(11) NOT NULL AUTO_INCREMENT ,
   ID_PERS INT(11) NOT NULL  ,
   ADR_VOIE VARCHAR(32) NOT NULL  ,
   ADR_CP VARCHAR(32) NOT NULL  ,
   ADR_VILLE VARCHAR(32) NOT NULL  
   , PRIMARY KEY (ID_ADDRESSE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PERSONNE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PERSONNE
 (
   ID_PERS INT(11) NOT NULL AUTO_INCREMENT ,
   PASSWORD_USER VARCHAR(32) NOT NULL  ,
   NOM_PERS VARCHAR(32) NOT NULL  ,
   PRENOM_PERS VARCHAR(32) NOT NULL  ,
   TELEPHONE VARCHAR(32) NOT NULL  ,
   EMAIL VARCHAR(32) NOT NULL  ,
   IMAGE_PERS VARCHAR(50) NULL  ,
   TYPE_USER VARCHAR(32) NOT NULL  
   , PRIMARY KEY (ID_PERS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : TYPE_PAIEMENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TYPE_PAIEMENT
 (
   MODE_PAIEMENT VARCHAR(32) NOT NULL  ,
   ID_CMDE INT(11) NOT NULL ,
   LIBELLE_PAIEMENT VARCHAR(32) NOT NULL  
   , PRIMARY KEY (MODE_PAIEMENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : COMMANDE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMMANDE
 (
   ID_CMDE INT(11) NOT NULL AUTO_INCREMENT ,
   ID_PERS INT(11) NOT NULL  ,
   DATE_CMDE DATETIME NOT NULL  
   , PRIMARY KEY (ID_CMDE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : AVIS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AVIS
 (
   ID_AVIS INT(11) NOT NULL  AUTO_INCREMENT,
   REF_PROD VARCHAR(32) NOT NULL  ,
   ID_PERS INT(11) NOT NULL  ,
   MESSAGE TEXT NOT NULL  ,
   DATE_HEURE DATETIME NOT NULL  
   , PRIMARY KEY (ID_AVIS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CODE_PROMO
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CODE_PROMO
 (
   ID_CODE INT(11) NOT NULL AUTO_INCREMENT ,
   CODE VARCHAR(32) NOT NULL  
   , PRIMARY KEY (ID_CODE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLIENT
 (
   ID_PERS INT(11) NOT NULL  ,
   PASSWORD_USER VARCHAR(32) NOT NULL  ,
   NOM_PERS VARCHAR(32) NOT NULL  ,
   PRENOM_PERS VARCHAR(32) NOT NULL  ,
   TELEPHONE VARCHAR(32) NOT NULL  ,
   EMAIL VARCHAR(32) NOT NULL  ,
   IMAGE_PERS VARCHAR(50) NULL  ,
   TYPE_USER VARCHAR(32) NOT NULL  
   , PRIMARY KEY (ID_PERS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PRODUIT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PRODUIT
 (
   REF_PROD VARCHAR(32) NOT NULL  ,
   ID_CAT INT(11) NOT NULL  ,
   ID_PERS INT(11) NOT NULL  ,
   LABELS VARCHAR(32) NOT NULL  ,
   PRIX DECIMAL(13,2) NOT NULL  ,
   QUANTITE INT(11) NOT NULL  ,
   DESCRIPTION TEXT NOT NULL  ,
   IMAGE_PROD VARCHAR(50) NOT NULL  
   , PRIMARY KEY (REF_PROD) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CATEGORIE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATEGORIE
 (
   ID_CAT INT(11) NOT NULL AUTO_INCREMENT ,
   NOM_CAT VARCHAR(32) NOT NULL  
   , PRIMARY KEY (ID_CAT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PRESTATAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PRESTATAIRE
 (
   ID_PERS INT(11) NOT NULL  ,
   PASSWORD_USER VARCHAR(32) NOT NULL  ,
   NOM_PERS VARCHAR(32) NOT NULL  ,
   PRENOM_PERS VARCHAR(32) NOT NULL  ,
   TELEPHONE VARCHAR(32) NOT NULL  ,
   EMAIL VARCHAR(32) NOT NULL  ,
   IMAGE_PERS VARCHAR(50) NULL  ,
   TYPE_USER VARCHAR(32) NOT NULL  
   , PRIMARY KEY (ID_PERS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CONTACTER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONTACTER
 (
   ID_PERS INT(11) NOT NULL  ,
   ID_PERS_1 INT(11) NOT NULL  ,
   ID_MESSAGE INT(11) NOT NULL AUTO_INCREMENT,
   MESSAGE TEXT NOT NULL  ,
   DATE_HEURE DATETIME NOT NULL  
   , PRIMARY KEY (ID_PERS,ID_PERS_1,ID_MESSAGE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : AVOIR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AVOIR
 (
   ID_CMDE INT(11) NOT NULL  ,
   ID_CODE INT(11) NOT NULL  
   , PRIMARY KEY (ID_CMDE,ID_CODE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : POSSEDER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS POSSEDER
 (
   ID_CMDE INT(11) NOT NULL  ,
   REF_PROD VARCHAR(32) NOT NULL  ,
   QTE_CMDE INT(11) NOT NULL  ,
   PRIX_CMDE DECIMAL(13,2) NOT NULL  
   , PRIMARY KEY (ID_CMDE,REF_PROD) 
 ) 
 comment = "";


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE ADDRESSE 
  ADD FOREIGN KEY FK_ADDRESSE_PERSONNE (ID_PERS)
      REFERENCES PERSONNE (ID_PERS) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE TYPE_PAIEMENT 
  ADD FOREIGN KEY FK_TYPE_PAIEMENT_COMMANDE (ID_CMDE)
      REFERENCES COMMANDE (ID_CMDE) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE COMMANDE 
  ADD FOREIGN KEY FK_COMMANDE_CLIENT (ID_PERS)
      REFERENCES CLIENT (ID_PERS) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE AVIS 
  ADD FOREIGN KEY FK_AVIS_PRODUIT (REF_PROD)
      REFERENCES PRODUIT (REF_PROD) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE AVIS 
  ADD FOREIGN KEY FK_AVIS_CLIENT (ID_PERS)
      REFERENCES CLIENT (ID_PERS) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE CLIENT 
  ADD FOREIGN KEY FK_CLIENT_PERSONNE (ID_PERS)
      REFERENCES PERSONNE (ID_PERS) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE PRODUIT 
  ADD FOREIGN KEY FK_PRODUIT_CATEGORIE (ID_CAT)
      REFERENCES CATEGORIE (ID_CAT) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE PRODUIT 
  ADD FOREIGN KEY FK_PRODUIT_PRESTATAIRE (ID_PERS)
      REFERENCES PRESTATAIRE (ID_PERS) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE PRESTATAIRE 
  ADD FOREIGN KEY FK_PRESTATAIRE_PERSONNE (ID_PERS)
      REFERENCES PERSONNE (ID_PERS) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE CONTACTER 
  ADD FOREIGN KEY FK_CONTACTER_CLIENT (ID_PERS)
      REFERENCES CLIENT (ID_PERS) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE CONTACTER 
  ADD FOREIGN KEY FK_CONTACTER_PRESTATAIRE (ID_PERS_1)
      REFERENCES PRESTATAIRE (ID_PERS) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE AVOIR 
  ADD FOREIGN KEY FK_AVOIR_COMMANDE (ID_CMDE)
      REFERENCES COMMANDE (ID_CMDE) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE AVOIR 
  ADD FOREIGN KEY FK_AVOIR_CODE_PROMO (ID_CODE)
      REFERENCES CODE_PROMO (ID_CODE) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE POSSEDER 
  ADD FOREIGN KEY FK_POSSEDER_COMMANDE (ID_CMDE)
      REFERENCES COMMANDE (ID_CMDE) ON DELETE SET NULL ON UPDATE SET NULL;


ALTER TABLE POSSEDER 
  ADD FOREIGN KEY FK_POSSEDER_PRODUIT (REF_PROD)
      REFERENCES PRODUIT (REF_PROD) ON DELETE SET NULL ON UPDATE SET NULL;

