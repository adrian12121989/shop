
<style type="text/css"> .head { color: green; } </style>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
// General
	$lang['system_system_name'] = "Home..";
	
	//admin panel
	$lang['job_volunteer'] = 'Create Job';
	$lang['create_training'] = 'Create Project';
	$lang['view_users'] = 'View Registered Applicants';
	$lang['add_moderator'] = 'Add Moderator';
	$lang['posted_date'] = 'Posted on';
	$lang['manage_jobs'] = 'Manage Jobs';
	$lang['applications_recieved'] = 'Applications Recieved';
	$lang['short_listed'] = 'Short Listed Candidates';
	$lang['interviews'] = 'Previous Interview';
	$lang['qualified_candidates'] = 'Qualified Applicants';
	
	//applicant_details //view_reg_users.php
	$lang['view_app_header'] = "<div class='head'>Successfull Registered Applicants</div>";
	$lang['applicant_full_name'] = 'Full name';
	$lang['applicant_email'] = 'E-mail';
	$lang['applicant_address'] = 'Address';
	$lang['applicant_mobile'] = 'Mobile';
	$lang['application_for'] = 'Applied for';
	$lang['app_date'] = 'Applied date';
	$lang['manage_users_header'] = "<div class='head'>System users</div>";
	
	//admin-add_user.php
	$lang['add_user_header'] = "<div class='head'>Add New System User</div>";
	$lang['usr_email'] = 'E-mail Address';
	$lang['confirm_usr_email'] = 'Conirm E-mail Address';
	$lang['user_permision'] = 'Create User Permision';
	$lang['manage_users'] = 'Manage System Users';
	
	//cv
	$lang['cv_error'] = '<p>Preview CV FAILED....! Seems we lack some of your information</p>
									Make sure you\'ve submited at least the following requirements and try again. Thanks
										<ul>
										<li>Personal details</li>
										<li>Contacts details</li>
										<li>Academic qualifications and,</li>
										<li>At least two referees of your choice</li>
										</ul>';

	
	//view application ..viewMyapplication.php
	$lang['view_application_header'] = "<div class='head'>You currently have the following applications</div>";
	$lang['job_name'] = 'Institution';
	$lang['job_type'] = 'Job type';
	$lang['application_date'] = 'Application date';
	$lang['location'] = 'Location';
	$lang['application_status'] = 'Status';
	$lang['applicant_name'] = 'Applicant name';
	
	// Jobs - create.php
	$lang['job_create_form_instruction_1'] = "Enter the information about your job advert below...";
	$lang['job_create_form_instruction_2'] = "Job advert success,.. Upadate or click the link add new to add new job advert...";
	$lang['job_title'] = "Title";
	$lang['job_desc'] = "Description";
	$lang['type'] = "Job type";
	$lang['cat'] = "Department";
	$lang['loc'] = "Location";
	$lang['job_start_date'] = "Start date";
	$lang['job_rate'] = "Rate";
	$lang['job_advertiser_name'] = "Name (or company name)";
	$lang['job_advertiser_email'] = "E-mail address";
	$lang['job_advertiser_phone'] = "Phone number";
	$lang['job_sunset_date'] = "Deadline";
	$lang['user_info_help'] = '<p>Application FAILED....! Seems we lack some of your information</p>
									Make sure you\'ve submited at least the following requirements and try again. Thanks
										<ul>
										<li>Personal details</li>
										<li>Contact details</li>
										<li>Academic qualifications and,</li>
										<li>At least two referees of your choice</li>
										</ul>';

	$lang['job_sunset_date_help'] = "Your job advert will be live up to this date.";
	$lang['common_form_element_go'] = "Advertise this Job";
	$lang['common_form_element_update'] = "Update this Job";
	$lang['common_form_element_cancel'] = "Not now, Thanks";
	$lang['save_success_okay'] = "Congrats!..Your advertisement has been saved";
	$lang['save_success_fail'] = "<font color='red'>Your advertisement cannot be saved at this time, correct errors and try again</font>";

	
	//login form
	$lang['admin_login_header_login'] = "<div class='head'>Please Login...</div>";
	$lang['admin_login_email'] = "E-mail Address";
	$lang['admin_login_password'] = "Password";
	$lang['admin_login_signin_login'] = "GO...";
	$lang['admin_login_error'] = "You Have Supplied Wrong Credentials Try Again!!!";
	
	//change password
	$lang['changepass_header'] = "<div class='head'>Change your Password...</div>";
	$lang['changepass_old'] = "Old Password";
	$lang['changepass_new'] = "New Password";
	$lang['changepass_confirm'] = "Confirm New Password";
	$lang['changepass_signin'] = "GO...";
	$lang['old_pass_fail'] = "Old password is invalid..Try Again!!!";
	$lang['message_success'] = 'Your password changed successfully!';
	$lang['message_fail'] = 'Something went wrong!';
	
	//personal details
	$lang['personal_header'] = "<div class='head'>Fill your Personal Information...</div>";
	$lang['personal_header_edit'] = "<div class='head'>Info not correct?...Update them here!</div>";
	$lang['first_name'] = "Fist Name";
	$lang['middle_name'] = "Middle Name";
	$lang['last_name'] = "Last Name";
	$lang['changepass_signin'] = "GO...";
	$lang['old_pass_fail'] = "Old password is invalid..Try Again!!!";
	$lang['personal_success'] = 'Your personal details saved successfully!';
	$lang['personal_fail'] = 'Something went wrong!';
	$lang['dob'] = 'Date of Birth';
	$lang['place_birth'] = 'Place of Birth';
	$lang['nationality'] = 'Nationality';
	$lang['marital_status'] = 'Marital Status';
	$lang['p_gender'] = 'Gender';
	$lang['p_email'] = 'E-mail Address';
	$lang['disability'] = 'Disability';
	$lang['p_experience'] = 'Year of Work Experience';
	
	//contact details
	$lang['contact_header'] = "<div class='head'>Fill your Personal Contact Details";
	$lang['contact_header_update'] = "<div class='head'>Okey!.. Here you can now Edit yo Info";
	$lang['p_email'] = 'E-mail Address';
	$lang['p_mobile'] = 'Mobile Number';
	$lang['p_current_address'] = 'Current Address';
	$lang['p_permanent_address'] = 'Permanent Address';
	$lang['p_work_telephone'] = 'Work Telephone';
	$lang['p_country'] = 'Country';
	$lang['p_region'] = 'Current Region';
	$lang['country_mention'] = 'Mention Country';
	
	//training
	$lang['training_header'] = "<div class='head'>Fill Training Information</div>";
	$lang['training_header_update'] = "<div class='head'>Update Your Info... If you wish!</div>";
	$lang['description'] = 'Training Description';
	$lang['t_institution'] = 'Institution Name & Address';
	$lang['start_date'] = 'Start Date';
	$lang['end_date'] = 'End Date';
	$lang['attachment'] = 'Attachment (optional)';
	$lang['supervisor_address'] = 'Supervisor Name & Address';
	$lang['training_institution'] = 'Institution';
	$lang['supervisor'] = 'Supervisor';
	
	//qualification details
	$lang['qualification_header'] = "<div class='head'>Fill your Academic Qualification</div>";
	$lang['qualification_header_update'] = "<div class='head'>Update your Info,.. If you wish!</div>";
	$lang['level_education'] = 'Education Level';
	$lang['institute_name'] = 'Institution';
	$lang['institute_mention'] = 'Mention your Institution Name';
	$lang['course_name'] = 'Course';
	$lang['acc_time_start'] = 'Start Year';
	$lang['acc_time_end'] = 'End Year';
	$lang['country'] = 'Country';
	$lang['index_no'] = 'Index. No';
	$lang['institute_name_mention'] = 'Mention Institution Name';
	$lang['course_mention'] = 'Mention Course Name';
	$lang['academic_message_success'] = 'Congrats! Data saved successfully';
	$lang['gender'] = 'Gender';
	$lang['m_status'] = 'Marrital Status';
	$lang['disability'] = 'Any Disability';
	$lang['acc_attachment'] = 'Attachment';
	$lang['certificate'] = 'Certificate';
	
	//experience
	$lang['work_header'] = "<div class='head'>Details For Work Experience..</div>";
	$lang['job_title'] = 'Job Title';
	$lang['supervisor_name'] = 'Supervisor\'s name';
	$lang['work_supervisor_address'] = 'Supervisor Address';
	$lang['supervisor_mobile'] = 'Supervisor Mobile';
	$lang['duties'] = 'Duties & Responsibilities';
	
	//referees
	$lang['r_header'] = "<div class='head'>Referees Details..</div>";
	$lang['r_title'] = 'Title';
	$lang['r_institution'] = 'Institution Name';
	$lang['r_address'] = 'Address';
	$lang['r_mobile'] = 'Mobile';
	$lang['r_email'] = 'E-mail Address';
	$lang['r_name'] = 'Full Name';
	
	//register form
	$lang['admin_login_header_register'] = "<div class='head'>Please register here..</div>";
	$lang['admin_login_email'] = "E-mail Address";
	$lang['admin_login_email_confirm'] = "Confirm E-mail Address";
	$lang['admin_login_password'] = "Password";
	$lang['admin_login_password_confirm'] = "Confirm Password";
	$lang['admin_login_signin_register'] = "GO...";
	$lang['user_registered'] = "Registration success....Congrats! Have another Go..!!!";
// Jobs - view.php
	$lang['jobs_view_apply'] = "Apply";
	$lang['jobs_view_search'] = "Search";
	
	//dashboard menu
	$lang['personal_details'] = "Personal Details";
	$lang['personal_contact'] = 'Contact Details';
	$lang['academic_qualification'] = 'Academic Qualification';
	$lang['training_workshop'] = 'Training & Workshop';
	$lang['work_experience'] = 'Working Experience';
	$lang['language_proficiency'] = 'Language Proficiency';
	$lang['computer_skills'] = 'Computer Skills';
	$lang['referees'] = 'Referees';
	$lang['other_attachment'] = 'Other Attachment(s)';
	$lang['declaration'] = 'Declaration';
	$lang['curriculum_vitae'] = 'Verify your Curriculum Vitae (CV)';
	$lang['preview_cv'] = 'Preview';
	$lang['download_cv'] = 'Download';
	
//footer
	$lang['Footer_copy'] = '<b>Copyright &copy 4G Experience - </b> ';
?>
