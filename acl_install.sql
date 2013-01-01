--
-- Install Default Permisions
--

INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Access ACL', 'access_acl', 'allows access to view, and change settings in, the ACL');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Add User', 'add_user', 'gives ability to add users');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Add Role', 'add_role', 'gives ability to add roles to the system');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Add Permissions', 'add_perm', 'gives the ability to add new permissions to the system');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Assign Role', 'assign_role', 'ability to assign roles to users');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Edit User', 'edit_user', 'gives the ability to edit users personal details');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Delete User', 'delete_user', 'ability to delete a user from the system');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('View Users', 'view_users', 'ability to view user details (inc. personal details)');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Edit Permission', 'edit_perm', 'ability to edit permissions');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Edit Role', 'edit_role', 'ability to edit roles');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Delete Permission', 'delete_perm', 'ability to delete permissions from the system');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('Delete Role', 'delete_role', 'ability to delete roles');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('View Permissions', 'view_perms', 'view available permissions');
INSERT INTO `perm` (`name`, `slug`, `description`) VALUES ('View Roles', 'view_roles', 'ability to view available roles');

--
-- Install Default User Roles
--

INSERT INTO `role` (`name`, `slug`, `description`) VALUES ('Developer', 'developer', 'this is someone who maintains the system\'s database, codebase, etc...');
INSERT INTO `role` (`name`, `slug`, `description`) VALUES ('Administrator', 'admin', 'this is someone who manages the system from the ui. they have access to the acl, user details, and more...');

--
-- Install Default Role Permission Relations
--

INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('1', '1');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('1', '4');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('1', '9');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('1', '11');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('1', '14');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('1', '13');

INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '1');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '2');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '3');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '5');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '6');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '7');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '8');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '10');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '13');
INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES ('2', '14');

--
-- Install Default Users
--

INSERT INTO `user` (`name`, `email`, `password`) VALUES ('Demo Account', 'demo@example.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86');

--
-- Install Default USer Role Relations
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES ('1', '1');
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES ('1', '2');