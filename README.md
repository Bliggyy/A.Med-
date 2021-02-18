# A.Med-
A project in Web Development 

The project is finished and ready to be presented

There is however still room for improvement and I'd like to note down some of them:
- addition of a notification area where a patient will be notified if their booked 
appointment has either been approved or denied. For the doctors, they will be 
notified if a patient user has booked an appointment
- addition of an admin account and admin page that verifies doctor accounts and is able to access/view all user accounts (somewhat completed)
- properly set up the doctor verification so that the doctor is not yet "registered"
after clicking on the register button and instead sent to a screen that tells them
to wait for their account to be verified
- add styling to the profiles
- add deletion/disabling of accounts
- create an appointment list for both doctors and patients and as well as a history of 
past appointments
- fix bugs
- create a modal that shows error/success messages instead of the usual alert messages shown in javascript

For the calendar specifically:
- change the calendar so users can add an appointment with a click on a date on the calendar
- create a system where the doctor can add patients and those patients will be under him and when he makes an appointment he can select a patient based on the patients that are under him
- make adjustments to the appointment system
  - the error code, most prefrerably show the time slots that are available after an error

How to install files and all dependencies:
- create a db called **a.med**
```
npm install
composter intall
php artisan migrate
```
