<?php

function is_not_admin()
{
    $ci = get_instance();
    if ($ci->session->userdata('id_akses') != 2) {
        redirect('landing_home');
    }
}