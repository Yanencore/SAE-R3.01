<?php

interface IUserBDD {
    public function saveUser(User $user): bool;
    public function findUserByEmail(string $email): ?User;
    public function createUserToken(string $email): string;
    public function isUserConnected(): bool;
    public function deleteYourAccount(): void;
    public function getUserId(): ?int;
    public function didTheSurvey(): bool;
}

