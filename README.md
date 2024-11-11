Midterm Instruction Guide
1. Project Overview
This project is a web-based application designed for managing students, subjects, and user login. It includes features for student data management, subject assignment, and user authentication.
________________________________________
2. Files and Functions Overview
•	index.php: Entry point of the application. Contains the login form and calls relevant functions to validate user credentials.
•	dashboard.php: Protected page that shows a welcome message and options for managing students and subjects. Requires a valid user session.
•	student.php / subject.php: Pages for managing students and subjects. Here, you can add, edit, and list students or subjects.
•	functions.php: Contains core functions used across the application for user validation, session management, and data handling.
Directory Structure
root/
├── dashboard.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── logout.php
├── student/
│   ├── attach-subject.php
│   ├── delete.php
│   ├── dettach-subject.php
│   ├── edit.php
│   └── register.php
└── subject/
    ├── add.php
    ├── delete.php
    └── edit.php

3. Key Functions in functions.php
User Authentication
•	getUsers()
•	validateLoginCredentials($email, $password)
•	checkLoginCredentials($email, $password, $users)
•	checkUserSessionIsActive()
Session Management
•	guard().
Error Handling
•	displayErrors($errors)
•	renderErrorsToView($error)
Student Management
•	validateStudentData($student_data)
•	checkDuplicateStudentData($student_data)
•	getSelectedStudentIndex($student_id)
•	getSelectedStudentData($index)
Subject Management
•	validateSubjectData($subject_data)
•	checkDuplicateSubjectData($subject_data)
•	getSelectedSubjectIndex($subject_code)
•	getSelectedSubjectData($index)
•	validateAttachedSubject($subject_data)
Functions Glossary:
getUsers()
This PHP function getUsers() returns a hardcoded array of 5 users, each with an email and password

validateLoginCredentials($email, $password)
This PHP function validates login credentials by checking if the provided email and password are valid. It returns an array of error messages if the email is empty, not in a valid email format, or if the password is empty.

checkLoginCredentials($email, $password, $users)
This function checks if a given email and password match any user in the provided list of users. It returns true if a match is found, and false otherwise. Note that this function is case-sensitive and does not hash passwords, which is not recommended for secure password storage.

checkUserSessionIsActive()
This function checks if a user's session is active by verifying the existence of an email address in the session. If the email is present, it then checks if a current page is set in the session. If both conditions are met, it redirects the user to the current page using the header function.

guard()
This is a PHP function named guard() that checks if a user is logged in by verifying the existence and non-emptiness of the email key in the $_SESSION superglobal array. If the condition is not met, it redirects the user to the base URL of the application.

displayErrors($errors)
This function takes an array of error messages ($errors) and returns a formatted HTML string displaying the errors in an unordered list, preceded by a bold heading "System Errors".

renderErrorsToView($error)
This PHP function, renderErrorsToView, takes an error message as input and returns a formatted HTML alert box containing the error message if the input is not empty. If the input is empty, it returns null. The alert box is styled with Bootstrap classes for a danger alert with a dismissible close button.

getBaseURL()
This function returns the base URL of the application as a string, e.g. http://dct-ccs.test/midterms/.

validateStudentData($student_data)
This PHP function validates student data by checking if 'student_id', 'first_name', and 'last_name' are not empty. If any of these fields are empty, it adds a corresponding error message to the $errors array, which is then returned. If no errors are found, an empty array is returned.

checkDuplicateStudentData($student_data)
This function takes in a parameter $student_data. It checks if the $_SESSION['student_data'] array is set and not empty. If it is, it iterates over each element in the array and compares the student_id of the current element with the student_id of the $student_data parameter. If a match is found, it adds the string <li>Duplicate Student ID</li> to an array named $errors. If no match is found, an empty array is returned. The function uses the null coalescing operator ?? to return an empty array if $errors is null.

getSelectedStudentIndex($student_id)
This PHP function getSelectedStudentIndex finds and returns the index of a student in the $_SESSION['student_data'] array based on the provided $student_id. If the student is not found, it returns null.

getSelectedStudentData($index)
This function retrieves a student's data from the session variable student_data based on the provided index. If the index exists, it returns the corresponding student data; otherwise, it returns null.

validateSubjectData($subject_data)
This PHP function validates subject data by checking if 'subject_code' and 'subject_name' are not empty. If either is empty, it adds a corresponding error message to the $errors array, which is then returned. If no errors are found, an empty array is returned.

checkDuplicateSubjectData($subject_data)
This PHP function checks if a subject already exists in the session data by comparing its code or name with existing subjects. If a duplicate is found, it returns an error message.

getSelectedSubjectIndex($subject_code)
This PHP function, getSelectedSubjectIndex, finds the index of a subject in the $_SESSION['subject_data'] array based on its subject_code. If found, it returns the index; otherwise, it returns null.

getSelectedSubjectData($index)
This function retrieves subject data from the session variable $_SESSION['subject_data'] based on the provided index. If the index exists, it returns the corresponding subject data; otherwise, it returns null.

validateAttachedSubject($subject_data)
This function checks if at least one subject is selected in the provided $subject_data. If not, it returns an error message indicating that at least one subject should be selected. Otherwise, it returns an empty array.
________________________________________
4. Core Project Functionalities
1. Login Process
•	Users can log in from index.php by providing their email and password.
•	On successful login, the application redirects the user to dashboard.php.
•	If login fails, relevant error messages display.
2. Student Management
•	Adding a Student:
o	Navigate to student.php, enter the student's ID, first name, and last name.
o	The form validates entries and prevents duplicate IDs.
•	Editing a Student:
o	Select a student from the list, modify details, and save.
•	Viewing Students:
o	Students display in a list, showing ID, name, and actions.
3. Subject Management
•	Adding a Subject:
o	Go to subject.php, enter the subject code and name.
o	Form validates required fields and prevents duplicate entries.
•	Editing a Subject:
o	Modify the subject details as needed.
•	Viewing Subjects:
o	Lists all added subjects, displaying code, name, and actions.
4. Assigning Subjects to Students
•	Attaching Subjects:
o	After selecting a student, attach one or more subjects.
o	A validation function ensures that at least one subject is selected.
________________________________________
5. Session and Page Guarding
Ensure that sensitive pages like dashboard.php, student.php, and subject.php are protected. Use guard() at the top of each page to prevent unauthorized access.
________________________________________
6. Running the Application
1.	Ensure the project files are hosted on a PHP server (like XAMPP, WAMP or Laragon).
2.	Access the project URL (e.g., http://localhost/project-directory/).
3.	Use the login credentials defined in getUsers() (like user1@email.com and password).
4.	Once logged in, navigate to dashboard.php to manage students and subjects.
________________________________________
7. Git Requirements for Code Submissions
•	Git Commits: Ensure each feature or change has a clear, detailed commit message.
•	Branching: Create branches for each feature or bug fix.

