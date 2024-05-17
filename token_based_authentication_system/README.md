**Project Overview**

The login system project is a robust authentication solution utilizing various technologies such as PHP, MySQL, HTML, CSS, and JavaScript. It aims to provide a secure authentication mechanism for users accessing the system. The core functionality revolves around token-based authentication, ensuring enhanced security measures and user convenience.

**Authentication Mechanism**

The project incorporates token-based authentication to authenticate users securely. Upon successful login, tokens with expiry dates are generated and stored both in the backend database and as browser cookies. These tokens serve as credentials for accessing protected resources within the system.

**User Experience**

The system provides a seamless user experience by automatically authenticating users upon accessing protected resources if their tokens are valid. In case of token expiration, users are prompted to log in again to obtain a new token. Additionally, the logout process effectively terminates user sessions by deleting tokens from both the browser and the server, enhancing security measures.

**Project Dependencies**

XAMPP for PHP and MySQL:
XAMPP is utilized as the local development environment, providing Apache for PHP and MySQL database services. It simplifies the setup process by bundling essential tools required for web development.

Composer for Installing MySQLiDB Library:
Composer serves as the dependency manager for PHP within the project. It streamlines the installation of libraries and packages, ensuring efficient management of project dependencies. The MySQLiDB library, essential for seamless database interactions, is installed via Composer, enhancing the project's scalability and maintainability.

**File Structure**

**index.html**

Role: This file serves as the primary interface for users to access the login and sign-up forms, enabling them to authenticate into the system.

**home.html**

Role: Upon successful authentication, users are directed to this page, which acts as their personalized dashboard. It dynamically displays content tailored to individual user preferences, providing a seamless and intuitive user experience.

**api.php:**

Role: This pivotal file acts as the backend handler for various types of requests, including sign-up, login, and logout. Based on the request method, it invokes the corresponding functions to facilitate user interactions within the system.

**config.php:**

Role: Establishing a secure connection to the database, this file plays a crucial role in facilitating seamless database operations throughout the project. It ensures efficient data management and retrieval processes, enhancing the overall functionality of the system.

**functions.php:**

**handleLogin($db)**
Functionality: This function orchestrates the login process by meticulously verifying user credentials, generating tokens with expiry dates upon successful authentication, and securely storing them in the backend database.

Response: Upon completion, it furnishes a comprehensive response array, encapsulating the login status, token details, and pertinent user information or any encountered error messages.

**handleSignup($db)**

Functionality: Responsible for managing user sign-up requests, this function meticulously validates input data, securely hashes passwords, and seamlessly inserts new user records into the database.

Response: It furnishes a detailed response array, indicating the success or failure of the sign-up process, ensuring users are seamlessly onboarded into the system.

**handleLogout($db)**

Functionality: Handling logout requests, this function efficiently deletes tokens associated with user sessions from the database and clears browser cookies, thereby effectively terminating user sessions.

Response: It provides a succinct response array, clearly indicating the success or failure of the logout process, ensuring users can securely exit their sessions.
By meticulously organizing these files and functions as described, the project ensures robust user authentication, seamless database interactions, and effective session management, thereby offering a secure and efficient login system implementation.

By organizing these files and functions as described, project effectively manages user authentication, database interactions, and user sessions, ensuring a secure and efficient login system implementation.

**Token-Based Authentication**

Token Generation and Storage:
Tokens with expiry dates are created upon successful login within the handleLogin() function. The generated tokens, along with their expiry dates, are securely stored in the backend database's tokens table and as browser cookies.

Access Control:
The system grants access to protected resources based on the validity of tokens. Users can access the home page and other protected resources without re-authenticating if their tokens are valid. However, upon token expiration, users are required to log in again to obtain new tokens for continued access.

Logout Process:
When a user initiates a logout action, the system deletes tokens associated with the user's session from both the backend database and the browser cookies. This comprehensive deletion process ensures the effective termination of user sessions, enhancing security measures within the system.

By implementing token-based authentication mechanisms, the project ensures robust security measures while prioritizing user convenience and seamless user experiences.

**Documentation Purpose**

This documentation aims to provide a comprehensive understanding of the project's structure, functionality, and usage. It caters to both contributors and end-users, offering insights into various aspects of the system, including file organization, authentication mechanisms, and user interaction processes.

**How to Run the Project**
- Setting Up and Running the Project using XAMPP:
- Ensure XAMPP is correctly installed on your system, providing Apache for PHP and MySQL database services.
- Place the project files (index.html, home.html, api.php, config.php, functions.php) within the XAMPP's htdocs directory.
- Start the Apache and MySQL services using the XAMPP Control Panel.
- Access the project by opening a web browser and visiting http://localhost/yourproject/index.html.

**Specific Configurations**

Before running the project, ensure that XAMPP's Apache and MySQL services are running.
Verify that the database configurations in config.php align with your local setup to establish a successful connection to the MySQL database.
