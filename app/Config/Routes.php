<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth Routes
$routes->get('/login', 'Auth::login');
$routes->post('/check-login', 'Auth::checkLogin');

$routes->get('/register', 'Auth::register');
$routes->post('/save-register', 'Auth::saveRegister');

$routes->get('/logout', 'Auth::logout');
$routes->get('drives', 'Api\PlacementDriveController::index');

$routes->get('forgot-password', 'Auth::forgotPassword');
$routes->post('send-reset-link', 'Auth::sendResetLink');

$routes->get('reset-password/(:any)', 'Auth::resetPassword/$1');
$routes->post('update-password', 'Auth::updatePassword');


// =========================
// SUPER ADMIN ROUTES
// =========================

$routes->group('super-admin', ['filter' => 'superadmin'], function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'SuperAdmin\Dashboard::index');

    // Admin Management
    $routes->get('admins', 'SuperAdmin\Admins::index');
    $routes->get('admins/create', 'SuperAdmin\Admins::create');
    $routes->post('admins/store', 'SuperAdmin\Admins::store');
    $routes->get('admins/edit/(:num)', 'SuperAdmin\Admins::edit/$1');
    $routes->post('admins/update/(:num)', 'SuperAdmin\Admins::update/$1');
    $routes->get('admins/toggle-status/(:num)', 'SuperAdmin\Admins::toggleStatus/$1');
    $routes->get(
    'activity-logs',
    'SuperAdmin\ActivityLogs::index'
);

    
});

// =========================
// ADMIN ROUTES
// =========================

$routes->group('admin', ['filter' => 'admin'], function ($routes) {

    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Departments
    $routes->get('departments', 'Admin\Department::index');
    $routes->get('departments/create', 'Admin\Department::create');
    $routes->post('departments/store', 'Admin\Department::store');
    $routes->get('departments/edit/(:num)', 'Admin\Department::edit/$1');
    $routes->post('departments/update/(:num)', 'Admin\Department::update/$1');
    $routes->get('departments/delete/(:num)', 'Admin\Department::delete/$1');

    // Students
    // Students
    $routes->get('students', 'Admin\Student::index');
    $routes->get('students/view/(:num)', 'Admin\Student::view/$1');
    $routes->get('students/delete/(:num)', 'Admin\Student::delete/$1');

    // Removed Students
    $routes->get('removed-students', 'Admin\Student::removedStudents');
    $routes->get('restore-student/(:num)', 'Admin\Student::restoreStudent/$1');
    // Companies
    $routes->get('companies', 'Admin\Company::index');
    $routes->get('companies/create', 'Admin\Company::create');
    $routes->post('companies/store', 'Admin\Company::store');
    $routes->get('companies/edit/(:num)', 'Admin\Company::edit/$1');
    $routes->post('companies/update/(:num)', 'Admin\Company::update/$1');
    $routes->get('companies/delete/(:num)', 'Admin\Company::delete/$1');

    // Placement Drives
    $routes->get('drives', 'Admin\PlacementDrive::index');
    $routes->get('drives/create', 'Admin\PlacementDrive::create');
    $routes->post('drives/store', 'Admin\PlacementDrive::store');
    $routes->get('drives/delete/(:num)', 'Admin\PlacementDrive::delete/$1');

    // Applications
    $routes->get('applications', 'Admin\Application::index');
    $routes->post(
        'applications/update-status/(:num)',
        'Admin\Application::updateStatus/$1'
    );

    // Resume Management
    $routes->get('resumes', 'Admin\Resume::index');

    // CSV Export
    $routes->get(
        'drives/export-applicants/(:num)',
        'Admin\PlacementDrive::exportApplicants/$1'
    );
});


// =========================
// STUDENT ROUTES
// =========================

$routes->group('student', ['filter' => 'student'], function ($routes) {

    $routes->get('dashboard', 'Student\Dashboard::index');

    // Profile
    $routes->get('profile', 'Student\Profile::index');
    $routes->post('profile/save', 'Student\Profile::save');

    // Drives
    $routes->get('drives', 'Student\Drive::index');
    $routes->get('drives/apply/(:num)', 'Student\Drive::apply/$1');

    // Applications
    $routes->get('applications', 'Student\Application::index');

    // Resume
    $routes->get('resume', 'Student\Resume::index');
    $routes->post('resume/upload', 'Student\Resume::upload');

    // Notifications
    $routes->get('notifications', 'Student\Notification::index');
});

// =========================
// API ROUTES
// =========================

$routes->group('api', function ($routes) {

    // Authentication
    $routes->post(
        'login',
        'Api\AuthController::login'
    );

    // Student
    $routes->get(
        'student/profile/(:num)',
        'Api\StudentController::profile/$1'
    );

    $routes->post(
        'student/update-profile',
        'Api\StudentController::updateProfile'
    );

    // Companies
    $routes->get(
        'companies',
        'Api\CompanyController::index'
    );

    $routes->get(
        'company/(:num)',
        'Api\CompanyController::show/$1'
    );

    // Placement Drives
    $routes->get(
        'drives',
        'Api\PlacementDriveController::index'
    );

    $routes->get(
        'drive/(:num)',
        'Api\PlacementDriveController::show/$1'
    );

    // Applications
    $routes->post(
        'apply',
        'Api\ApplicationController::apply'
    );

    $routes->get(
        'my-applications/(:num)',
        'Api\ApplicationController::myApplications/$1'
    );

    // Dashboard
    $routes->get(
        'dashboard-stats/(:num)',
        'Api\DashboardController::stats/$1'
    );

    // Resume
    $routes->post(
        'upload-resume',
        'Api\ResumeController::upload'
    );

    $routes->get(
        'resume/(:num)',
        'Api\ResumeController::getResume/$1'
    );

});