<?php

interface IUserBDD {
    public function saveUser(User $user): bool;
    public function findUserByEmail(string $email): ?User;
}

