<?php declare(strict_types=1);

namespace tests\api;

use ApiTester;
use tests\api\common\Cest;

class GroupCest extends Cest
{
    public function _fixtures(): array
    {
        return [
            'users' => \tests\fixtures\UserFixture::class,
            'courses' => \tests\fixtures\CourseFixture::class,
            'faculties' => \tests\fixtures\FacultyFixture::class,
            'specialities' => \tests\fixtures\SpecialtyFixture::class,
            'groups' => \tests\fixtures\GroupFixture::class,
        ];
    }

    public function testIndexAction(ApiTester $I): void
    {
        $url = '/admin/group/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'name' => 'ПМ',
            'course_id' => 1,
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'name' => 'ПМ',
                'course_id' => 1,
            ],
        ]);
    }
}
