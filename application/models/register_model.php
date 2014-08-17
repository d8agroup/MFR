<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_Model extends CI_Model
{
    const table_user_confirmation = 'user_confirmation';
    const table_users = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function new_user_confirm_code($user_id, $confirmation_code)
    {
        $user = $this->db->get_where(self::table_user_confirmation, array('user_id' => $user_id))->row();

        if(!isset($user->confirm_code))
        {
            $user_record = $this->db->get_where(self::table_users, array('id' => $user_id))->row();

            $this->db->insert(self::table_user_confirmation,
                array('user_id' => $user_id, 'confirm_code' => $confirmation_code));

            $confirmation_email = $this->load->view('users/email/confirm_email', array(
                'display_name' => $user_record->first_name." ".$user_record->last_name,
                'uri' => site_url("users/confirm_user/{$user_id}/{$confirmation_code}"),
            ), true);

            $this->load->library('email');

            $this->email->from("do-not-reply.mfr.com", "Monitor for Results");
            $this->email->to($user_record->email);

            $this->email->subject('Confirm your Registration');
            $this->email->message($confirmation_email);

            $this->email->send();
        }
        else
        {
            $user_record = $this->db->get_where(self::table_users, array('id' => $user_id))->row();

            $this->db->where('id', $user_id)
                ->update(self::table_user_confirmation, array('confirm_code' => $confirmation_code));

            $confirmation_email = $this->load->view('users/email/confirm_email', array(
                'display_name' => $user_record->first_name." ".$user_record->last_name,
                'uri' => site_url("users/confirm_user/{$user_id}/{$confirmation_code}"),
                'confirmation_code' => $confirmation_code,
            ), true);

            $this->load->library('email');

            $this->email->from("do-not-reply.mfr.com", "Monitor for Results");
            $this->email->to($user_record->email);

            $this->email->subject('Confirm your Registration');
            $this->email->message($confirmation_email);

            $this->email->send();
        }
    }

    public function confirm_user($user_id, $confirmation_code)
    {
        $user = $this->db->get_where(self::table_user_confirmation, array('user_id' => $user_id))->row();

        if(!isset($user->confirm_code))
        {
            return false;
        }
        else
        {
            if($user->confirm_code == $confirmation_code)
            {
                // Activate the user
                $this->db->where('id', $user_id)
                    ->update(self::table_users, array('active' => 1));

                // Remove confirmation from table
                $this->db->where('user_id', $user_id);
                $this->db->delete(self::table_user_confirmation);

                return true;
            }

            return false;
        }
    }
}