<?php
use App\User;

$user = User::where('id',2)->update(['cellphone'=>0]);
