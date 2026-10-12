<?php

return [
    'dashboard' => 'Dashboard',
    'requests' => 'Requests',
    'pending_validation' => 'Pending Validation',
    'department_budget' => 'Department Budget',
    'approved_requests' => 'Approved Requests',
    'rejected_requests' => 'Rejected Requests',
    'employees' => 'Employees',
    'add_employee' => 'Add Employee',
    'departments' => 'Departments',
    'quotations' => 'Quotations',
    'add_quotation' => 'Add Quotation',
    'purchase_orders' => 'Purchase Orders',
    'users' => 'Users',
    'roles' => 'Roles',
    'audit_logs' => 'Audit Logs',
    'my_profile' => 'My Profile',
    'logout' => 'Logout',

    'main_menu' => 'MAIN MENU',
    'procurement' => 'PROCUREMENT',
    'finance' => 'FINANCE',
    'ceo' => 'CEO',
    'employee_management' => 'EMPLOYEE MANAGEMENT',
    'organization' => 'ORGANIZATION',
    'administration' => 'ADMINISTRATION',
    'audit' => 'AUDIT',
    'account' => 'ACCOUNT',

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    'greeting' => 'HI, :name',
    'welcome' => 'Welcome to :app',

    'pending_requests' => 'Pending Requests',
    'awaiting_validation' => 'Awaiting validation',
    'total_approved' => 'Total approved',
    'active_employees' => 'Active employees',
    'current_allocation' => 'Current allocation',

    'today' => 'Today',
    'rejected' => 'Rejected',

    'recent_requests' => 'Recent Requests',
    'recent_requests_desc' => 'Latest requests submitted by employees',
    'view_all' => 'View all',
    'request' => 'Request',
    'employee' => 'Employee',
    'amount' => 'Amount',
    'status' => 'Status',
    'unknown' => 'Unknown',
    'na' => 'N/A',
    'no_recent_requests' => 'No recent requests found.',
    'pending' => 'Pending',
    'approved' => 'Approved',
    'rejected_status' => 'Rejected',

    'quick_actions' => 'Quick Actions',
    'frequently_used' => 'Frequently used modules',
    'new_request' => 'New Request',
    'new_request_desc' => 'Create a new request',
    'manage_employees' => 'Manage employees',
    'manage_budgets' => 'Manage budgets',
    'roles_permissions' => 'Roles & Permissions',
    'manage_access_control' => 'Manage access control',
    'review_system_activity' => 'Review system activity',
    'manage_procurement' => 'Manage procurement',
    'manage_quotations' => 'Manage quotations',
    'manage_purchase_orders' => 'Manage purchase orders',

    'budget_overview' => 'Budget Overview',
    'budget_overview_desc' => 'Department budget utilization',
    'view_budgets' => 'View budgets',
    'unknown_department' => 'Unknown Department',
    'used' => 'Used',
    'no_budgets' => 'No department budgets available.',

    'recent_activity' => 'Recent Activity',
    'recent_activity_desc' => 'Latest system activity',
    'view_logs' => 'View logs',
    'activity_placeholder' => 'Recent system activity is available in the audit logs.',
    'view_audit_logs' => 'View Audit Logs',

    /*
|--------------------------------------------------------------------------
| CREATE REQUEST
|--------------------------------------------------------------------------
*/


    // =========================================================
    // EMPLOYEE FORM
    // =========================================================

    'employee_create_title' => 'Create a New Employee',
    'employee_home' => 'Home',
    'employee_employees' => 'Employees',
    'employee_create' => 'Create',
    'employee_validation_title' => 'Please correct the following errors:',

    // Steps
    'employee_step_personal' => 'Personal',
    'employee_step_address' => 'Address',
    'employee_step_photo' => 'Photo',
    'employee_step_company' => 'Company',
    'employee_step_family' => 'Family',
    'employee_step_emergency' => 'Emergency',
    'employee_step_salary' => 'Salary',

    // General
    'employee_required' => 'This field is required.',
    'employee_select' => 'Select',
    'employee_optional' => 'Optional',
    'employee_previous' => 'Previous',
    'employee_next' => 'Next',
    'employee_cancel' => 'Cancel',
    'employee_save' => 'Save',
    'employee_saving' => 'Saving...',
    'employee_no_option' => 'No option available',

    // Personal information
    'employee_personal_title' => 'Personal Information',
    'employee_personal_desc' => 'Enter the employee’s personal information.',
    'employee_first_name' => 'First Name',
    'employee_first_name_placeholder' => 'John',
    'employee_middle_name' => 'Middle Name',
    'employee_middle_name_placeholder' => 'Michael',
    'employee_last_name' => 'Last Name',
    'employee_last_name_placeholder' => 'Doe',
    'employee_gender' => 'Gender',
    'employee_select_gender' => 'Select gender',
    'employee_date_of_birth' => 'Date of Birth',
    'employee_card_number' => 'ID / Card Number',
    'employee_card_placeholder' => 'NN338638245',
    'employee_country' => 'Country',
    'employee_select_country' => 'Select country',
    'employee_country_drc' => 'Democratic Republic of the Congo',
    'employee_country_zambia' => 'Zambia',
    'employee_country_south_africa' => 'South Africa',
    'employee_country_angola' => 'Angola',
    'employee_country_congo' => 'Republic of the Congo',
    'employee_marital_status' => 'Marital Status',
    'employee_select_marital_status' => 'Select marital status',

    // Address and contact
    'employee_address_title' => 'Address & Contact',
    'employee_address_desc' => 'Enter employee contact information.',
    'employee_work_phone' => 'Work Phone',
    'employee_personal_phone' => 'Personal Phone',
    'employee_phone_placeholder' => '+243 XXX XXX XXX',
    'employee_email' => 'Email Address',
    'employee_email_placeholder' => 'employee@example.com',
    'employee_address' => 'Address',
    'employee_address_placeholder' => 'Enter employee address',

    // Photo
    'employee_photo_title' => 'Employee Photo',
    'employee_photo_desc' => 'Upload an optional employee photo.',
    'employee_photo_upload' => 'Employee Photo',
    'employee_photo_hint' => 'JPG, JPEG or PNG. Maximum size: 2 MB.',
    'employee_photo_preview' => 'Employee photo preview',

    // Company
    'employee_company_title' => 'Company Information',
    'employee_company_desc' => 'Assign the employee to a department, section and job title.',
    'employee_department' => 'Department',
    'employee_select_department' => 'Select department',
    'employee_section' => 'Section',
    'employee_select_department_first' => 'Select department first',
    'employee_select_section' => 'Select section',
    'employee_no_section' => 'No section available',
    'employee_job_title' => 'Job Title',
    'employee_select_section_first' => 'Select section first',
    'employee_select_job_title' => 'Select job title',
    'employee_no_job_title' => 'No job title available',
    'employee_contract_type' => 'Contract Type',
    'employee_select_contract_type' => 'Select contract type',
    'employee_end_contract_date' => 'End Contract Date',
    'employee_work_location' => 'Work Location',
    'employee_select_work_location' => 'Select location',
    'employee_supervisor' => 'Supervisor',
    'employee_supervisor_placeholder' => 'Supervisor name',
    'employee_type' => 'Employee Type',
    'employee_select_type' => 'Select employee type',

    // Family
    'employee_family_title' => 'Family Information',
    'employee_family_desc' => 'Enter spouse and parent information.',
    'employee_spouse_information' => 'Spouse Information',
    'employee_spouse_status' => 'Status',
    'employee_select_status' => 'Select status',
    'employee_married' => 'Married',
    'employee_single' => 'Single',
    'employee_divorced' => 'Divorced',
    'employee_widowed' => 'Widowed',
    'employee_full_name' => 'Full Name',
    'employee_spouse_name_placeholder' => 'Spouse full name',
    'employee_phone' => 'Phone',
    'employee_parents_title' => 'Parents & In-Laws',
    'employee_parents_hint' => 'Enter the full name, telephone number and status of each parent.',
    'employee_father' => 'Father',
    'employee_mother' => 'Mother',
    'employee_father_in_law' => 'Father-in-law',
    'employee_mother_in_law' => 'Mother-in-law',
    'employee_parent_full_name' => 'Parent full name',
    'employee_deceased' => 'Deceased',

    // Emergency contact
    'employee_emergency_title' => 'Emergency Contact',
    'employee_emergency_desc' => 'Enter the employee’s emergency contact information.',
    'employee_relationship' => 'Relationship',
    'employee_select_relationship' => 'Select relationship',
    'employee_emergency_name_placeholder' => 'Emergency contact name',
    'employee_emergency_address_placeholder' => 'Emergency contact address',





    'create_request' => 'Create a New Request',
    'new_request_title' => 'New Request',
    'please_correct_errors' => 'Please correct the following errors:',
    'request_title' => 'Request Title',
    'request_title_placeholder' => 'Example: Request for construction materials',
    'description_remark' => 'Description / Remark',
    'description_placeholder' => 'Describe the reason for this request...',
    'item' => 'Item',
    'remove' => 'Remove',
    'item_name' => 'Item Name',
    'item_name_placeholder' => 'Keyboard',
    'item_name_placeholder_js' => 'Example: Cement',
    'quantity' => 'Quantity',
    'unit' => 'Unit',
    'unit_placeholder' => 'pcs, kg, m³...',
    'add_another_item' => 'Add Another Item',
    'cancel' => 'Cancel',
    'submit_request' => 'Submit Request',
    'submitting' => 'Submitting...',
    'add_at_least_one_item' => 'Please add at least one item to the request.',
    'create' => 'Create',
//    payroll

// =========================================================
    // PAYROLL  (lang/en/messages.php)
    // Paste this block inside the return [ ... ];
    // =========================================================

    'payroll_management' => 'PAYROLL MANAGEMENT',
    'payroll' => 'Payroll',
    'add_payroll' => 'Add Payroll',

    'pay_exchange_rate' => 'Exchange Rate',

    'pay_rate_auto' => 'Taux du jour',

    // Page
    'pay_title' => 'Pay Employee',
    'pay_home' => 'Home',
    'pay_page_title' => 'Pay Employee - AMC SARL',
    'pay_correct_errors' => 'Please correct the following errors:',

    // Employee info
    'pay_employee' => 'Employee',
    'pay_matricule' => 'Matricule',
    'pay_department' => 'Department',
    'pay_job_title' => 'Job Title',
    'pay_category_echelon' => 'Cat. / Ech. / Sal.',
    'pay_period' => 'Period',

    // Gains
    'pay_gains' => 'Gains',
    'pay_basic_salary' => 'Basic Salary',
    'pay_days_worked' => 'Days Worked',
    'pay_housing_allowance' => 'Housing Allowance',
    'pay_transport_allowance' => 'Transport Allowance',
    'pay_meal_allowance' => 'Meal Allowance',
    'pay_family_allowance' => 'Family Allowance',
    'pay_medical_allowance' => 'Medical Allowance',
    'pay_other_non_taxable' => 'Other Non-Taxable',
    'pay_other_taxable' => 'Other Taxable',
    'pay_bonus' => 'Bonus',
    'pay_overtime_hours' => 'Overtime Hours',
    'pay_overtime_amount' => 'Overtime Amount',
    'pay_sick_days' => 'Sick Days',

    // Deductions
    'pay_deductions' => 'Deductions',
    'pay_cnss_employee' => 'CNSS Employee',
    'pay_ipr' => 'IPR',
    'pay_salary_advances' => 'Salary Advances',
    'pay_syndicate_deduction' => 'Syndicate Deduction',
    'pay_other_deductions' => 'Other Deductions',
    'pay_ier' => 'IER',

    // Employer contributions
    'pay_employer_contributions' => 'Employer Contributions',
    'pay_cnss' => 'CNSS',
    'pay_inpp' => 'INPP',
    'pay_onem' => 'ONEM',

    // Summary
    'pay_gross_salary' => 'Gross Salary',
    'pay_total_deductions' => 'Total Deductions',
    'pay_net_salary' => 'Net Salary',
    'pay_remarks' => 'Remarks',

    // Buttons
    'pay_cancel' => 'Cancel',
    'pay_submit' => 'Pay Employee',
    'pay_saving' => 'Saving...',

//     salary



    'sal_title' => 'Salary Information',
    'sal_desc' => 'Recurring data used to pre-fill payroll every month',

    'sal_base_salary' => 'Base Salary',
    'sal_category' => 'Salary Category',
    'sal_select_category' => 'Select a category',
    'sal_echelon' => 'Echelon',
    'sal_echelon_auto' => 'Filled automatically from the category',
    'sal_currency' => 'Currency',

    // Payment methods
    'sal_payment_methods' => 'Payment Methods',
    'sal_payment_methods_hint' => 'You can select several',
    'sal_method_cash' => 'Cash',
    'sal_method_bank' => 'Bank Transfer',
    'sal_method_mobile' => 'Mobile Money',
    'sal_method_cheque' => 'Cheque',

    // Bank details
    'sal_bank_details' => 'Bank Details',
    'sal_bank_name' => 'Bank Name',
    'sal_bank_account_holder' => 'Account Holder',
    'sal_bank_account_number' => 'Account Number',
    'sal_rib' => 'RIB (file)',
    'sal_rib_hint' => 'PDF, JPG or PNG - 4 MB max',

    // Allowances
    'sal_allowances' => 'Recurring Allowances',
    'sal_housing' => 'Housing Allowance',
    'sal_transport' => 'Transport Allowance',
    'sal_meal' => 'Meal Allowance',
    'sal_family' => 'Family Allowance',
    'sal_medical' => 'Medical Allowance',
    'sal_other_non_taxable' => 'Other Non-Taxable',
    'sal_other_taxable' => 'Other Taxable',

    // Deductions
    'sal_recurring_deductions' => 'Recurring Deductions',
    'sal_cnss_employee' => 'CNSS Employee',
    'sal_syndicate' => 'Syndicate Deduction',
    'sal_ier' => 'IER',

    // Employer contributions
    'sal_employer_contributions' => 'Employer Contributions',
    'sal_cnss_employer' => 'CNSS Employer',
    'sal_inpp_employer' => 'INPP',
    'sal_onem_employer' => 'ONEM',

    'sal_section_base' => 'Base Salary',
    'sal_select_currency' => 'Select currency',

];
