<?php


namespace App\Repositories\Member;


use App\Repositories\BaseRepoInterface;

interface MemberRepoInterface extends BaseRepoInterface
{
    public function getWherePaid();
    public function getWhereNotPaid();
    public function getAllMemberEmails();
    public function getEmailsWhere(string $column, $value);
}
