<?php 

namespace domain\user;

class UserDTO
{
	public int $id = 0;
	public string $username = '';
	public string $email = '';
	public int $role = 0;
	public int $status = 0;
	public string $created_at = '';
	public string $updated_at = '';
}
