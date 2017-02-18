<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aleksandr_vashchenko_crud_model extends CI_Model
{
    /**
     * Makes query to DB for table info
     * @param string $where
     * @param string $limit
     * @return array
     */
    public function table($where, $limit)
    {
        $sql = "SELECT alek_users.id, alek_users.name, alek_users.surname, alek_users.email, GROUP_CONCAT(alek_groups.name SEPARATOR  '<br>') as groups
				FROM alek_users
                LEFT JOIN alek_users_groups ON alek_users_groups.user_id = alek_users.id
                LEFT JOIN alek_groups ON alek_users_groups.group_id = alek_groups.id
                WHERE 1
                {$where}
                GROUP BY alek_users.id
                {$limit}
				";

        return $this->db->query($sql)->result_array();
    }

    /**
     * Makes query to DB for groups info
     * @return array
     */
    public function groups_info()
    {
        return $this->db->get('alek_groups')->result_array();
    }

    /**
     * Makes query to DB for user's info
     * @param int $id
     * @return mixed
     */
    public function user_info($id)
    {
        $sql = "SELECT alek_users.id, alek_users.name, alek_users.surname, alek_users.email, GROUP_CONCAT(alek_groups.name SEPARATOR  ',') as groups
                FROM alek_users
                LEFT JOIN alek_users_groups ON alek_users_groups.user_id = alek_users.id
                LEFT JOIN alek_groups ON alek_users_groups.group_id = alek_groups.id
                WHERE alek_users.id = " . intval($id) . "
                GROUP BY alek_users.id
                LIMIT 1
               ";

        if ($this->db->query($sql)->result_array()) {
            return $this->db->query($sql)->result_array();

        } else {

            return false;
        }
    }

    /**
     * Makes query to DB for user info
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function verify_user($email, $password)
    {
        $query = $this
            ->db
            ->where('email', $email)
            ->where('password', md5($password))
            ->limit(1)
            ->get('alek_users');

        if ($query->row()) {
            return $query->row();
        }

        return false;
    }
}