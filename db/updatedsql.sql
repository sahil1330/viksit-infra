show tables;
show tables;
DESC users;
ALTER TABLE users ADD COLUMN critic_score int ;
ALTER TABLE users ADD COLUMN marks int ;
ALTER TABLE users DROP column avatar;
ALTER TABLE users
MODIFY COLUMN aadharCard varchar(255) NULL, 
MODIFY COLUMN pancard varchar(255) NULL,
MODIFY COLUMN no_of_workers varchar(255) NULL,  
MODIFY COLUMN documents varchar(255) NULL,
MODIFY COLUMN critic_score int NULL,  
MODIFY COLUMN marks int NULL,
MODIFY COLUMN createdAt varchar(255) NULL,
MODIFY COLUMN updatedAt varchar(255) NULL ;
Select * from users;
ALTER TABLE users ADD COLUMN fin_record varchar(255) NULL,ADD COLUMN tech_record varchar(255) NULL;
ALTER TABLE users DROP column documents;
DESC documents;
ALTER TABLE documents MODIFY COLUMN verificationStatus varchar(255) NULL;
ALTER TABLE documents MODIFY COLUMN rejectionMessage varchar(255) NULL, MODIFY COLUMN acceptanceMessage varchar(255) NULL;
ALTER TABLE documents ADD COLUMN createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP;
Select * from documents;
DESC blogs;
ALTER TABLE blogs ADD COLUMN blog_location varchar(255), RENAME COLUMN blo_image TO blog_image;