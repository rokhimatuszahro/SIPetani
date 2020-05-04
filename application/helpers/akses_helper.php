<?php

function is_not_admin()
{
    $ci = get_instance();
    if ($ci->session->userdata('id_akses') != 2) {
        redirect('landing_home');
    }
}
function session()
{
	$ci = get_instance();
	return $ci->session->userdata('email');
}
function is_not_user()
{
	$ci = get_instance();
	if ($ci->session->userdata('id_akses') != 1) {
		redirect('dashboard');
	}
}

