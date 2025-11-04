IF DB_ID(N'user_authenticator') IS NULL
BEGIN
	CREATE DATABASE [user_authenticator];

USE [user_authenticator];

CREATE TABLE [roles] (
    [role_id] INT IDENTITY(1,1) PRIMARY KEY,
    [role_name] NVARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE [users] (
    [id] INT IDENTITY(1,1) PRIMARY KEY,
    [username] NVARCHAR(50) NOT NULL UNIQUE,
    [password] NVARCHAR(255) NOT NULL,
    [role_id] INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

CREATE TABLE [permissions] (
    [permission_id] INT IDENTITY(1,1) PRIMARY KEY,
    [permission_name] NVARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE [role_permissions] (
    [role_id] INT NOT NULL,
    [permission_id] INT NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(role_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id)
);

INSERT INTO [roles] (role_name) VALUES ('admin'), ('editor'), ('viewer');

INSERT INTO [permissions] (permission_name) VALUES 
('create_content'), ('edit_content'), ('delete_content'), ('view_content');

INSERT INTO [role_permissions] (role_id, permission_id) VALUES
((SELECT role_id FROM roles WHERE role_name = 'admin'), (SELECT permission_id FROM permissions WHERE permission_name = 'create_content')),
((SELECT role_id FROM roles WHERE role_name = 'admin'), (SELECT permission_id FROM permissions WHERE permission_name = 'edit_content')),
((SELECT role_id FROM roles WHERE role_name = 'admin'), (SELECT permission_id FROM permissions WHERE permission_name = 'delete_content')),
((SELECT role_id FROM roles WHERE role_name = 'admin'), (SELECT permission_id FROM permissions WHERE permission_name = 'view_content')),
((SELECT role_id FROM roles WHERE role_name = 'editor'), (SELECT permission_id FROM permissions WHERE permission_name = 'create_content')),
((SELECT role_id FROM roles WHERE role_name = 'editor'), (SELECT permission_id FROM permissions WHERE permission_name = 'edit_content')),
((SELECT role_id FROM roles WHERE role_name = 'editor'), (SELECT permission_id FROM permissions WHERE permission_name = 'view_content')),
((SELECT role_id FROM roles WHERE role_name = 'viewer'), (SELECT permission_id FROM permissions WHERE permission_name = 'view_content'));

INSERT INTO [users] (username, password, role_id) VALUES
('admin_user', 'hashed_password_here', (SELECT role_id FROM roles WHERE role_name = 'admin')),
('editor_user', 'hashed_password_here', (SELECT role_id FROM roles WHERE role_name = 'editor')),
('viewer_user', 'hashed_password_here', (SELECT role_id FROM roles WHERE role_name = 'viewer'));

END