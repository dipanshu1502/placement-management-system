<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');

$routes->post('/check-login','Auth::checkLogin');

$routes->get('/register','Auth::register');

$routes->post('/save-register','Auth::saveRegister');

$routes->get('/logout','Auth::logout');

$routes->get('/admin/dashboard', 'Admin\Dashboard::index');

$routes->get('/student/dashboard', 'Student\Dashboard::index');

// Department Management

$routes->get('admin/departments', 'Admin\Department::index');
$routes->get('admin/departments/create', 'Admin\Department::create');
$routes->post('admin/departments/store', 'Admin\Department::store');

$routes->get('admin/departments/edit/(:num)', 'Admin\Department::edit/$1');
$routes->post('admin/departments/update/(:num)', 'Admin\Department::update/$1');

$routes->get('admin/departments/delete/(:num)', 'Admin\Department::delete/$1');

// Student Profile Routes
$routes->get(
    'student/profile',
    'Student\Profile::index'
);

$routes->post(
    'student/profile/save',
    'Student\Profile::save'
);

// Students Management

$routes->get(
    'admin/students',
    'Admin\Student::index'
);

$routes->get(
    'admin/students/view/(:num)',
    'Admin\Student::view/$1'
);

// Companies

$routes->get('admin/companies', 'Admin\Company::index');
$routes->get('admin/companies/create', 'Admin\Company::create');
$routes->post('admin/companies/store', 'Admin\Company::store');

$routes->get('admin/companies/edit/(:num)', 'Admin\Company::edit/$1');
$routes->post('admin/companies/update/(:num)', 'Admin\Company::update/$1');

$routes->get('admin/companies/delete/(:num)', 'Admin\Company::delete/$1');

// Placement Drives
$routes->get('admin/drives', 'Admin\PlacementDrive::index');
$routes->get('admin/drives/create', 'Admin\PlacementDrive::create');
$routes->post('admin/drives/store', 'Admin\PlacementDrive::store');
$routes->get('admin/drives/delete/(:num)', 'Admin\PlacementDrive::delete/$1');

// Student Drive Routes
$routes->get(
    'student/drives',
    'Student\Drive::index'
);

$routes->get(
    'student/drives/apply/(:num)',
    'Student\Drive::apply/$1'
);

// Student Application Routes
$routes->get(
    'student/applications',
    'Student\Application::index'
);


// Admin Application Routes
$routes->get(
    'admin/applications',
    'Admin\Application::index'
);

$routes->post(
    'admin/applications/update-status/(:num)',
    'Admin\Application::updateStatus/$1'
);

// Student Resume Routes
$routes->get('student/resume', 'Student\Resume::index');
$routes->post('student/resume/upload', 'Student\Resume::upload');

// Admin Resume Routes
$routes->get('admin/resumes', 'Admin\Resume::index');

// Student Notification Routes
$routes->get('student/notifications', 'Student\Notification::index');

// Admin Download Routes
$routes->get(
    'admin/drives/export-applicants/(:num)',
    'Admin\PlacementDrive::exportApplicants/$1'
);

// Forgot Password Routes
$routes->get(
    'forgot-password',
    'Auth::forgotPassword'
);

$routes->post(
    'send-reset-link',
    'Auth::sendResetLink'
);

// Reset Password Routes
$routes->get(
    'reset-password/(:any)',
    'Auth::resetPassword/$1'
);

$routes->post(
    'update-password',
    'Auth::updatePassword'
);