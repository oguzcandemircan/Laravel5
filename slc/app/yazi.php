<?php
// Userin Kopyası Class adını değiştir ve kullan
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class yazi extends Authenticatable
{
	protected $table="yazi";
}
