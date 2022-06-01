<?php

use tests\api\common\Cest;

class JournalCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => \tests\fixtures\UserFixture::class,
            'teachers' => \tests\fixtures\TeacherFixture::class,
            'journals' => \tests\fixtures\JournalFixture::class,
            'disciplines' => \tests\fixtures\DisciplineFixture::class,
            'groups' => \tests\fixtures\GroupFixture::class,
        ];
    }

    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/journal/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'name' => 'Математический анализ',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
              'id' => 1,
              'name' => 'Математический анализ',
            ],
        ]);
    }

    public function testReadAction(ApiTester $I)
    {
        $url = '/admin/journal/read?id=2';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'name' => 'Геометрия и Алгебра',
            ],
        ]);
    }

    public function testCreateAction(ApiTester $I)
    {
        $url = '/admin/journal/create';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);
        $data = [
            'name' => 'test-name',
            'teacher_id' => 3,
            'discipline_id' => 1,
        ];
        $I->sendPostAsJson($url, $data);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => $data
        ]);
    }

    public function testUpdateActionOneField(ApiTester $I)
    {
        $url = '/admin/journal/update?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($url, ['name' => 'test-name-updated']);
        
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'id' => 1,
                'name' => 'test-name-updated',
            ]
        ]);
    }

    public function testDeleteAction(ApiTester $I)
    {
        $readUrl = '/admin/journal/read?id=1';
        $I->sendGetAsJson($readUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $deleteUrl = '/admin/journal/delete?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($deleteUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $I->sendGetAsJson($readUrl);
        $I->seeResponseCodeIs(404);
    }
}
