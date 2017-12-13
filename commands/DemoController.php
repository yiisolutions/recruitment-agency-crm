<?php

namespace app\commands;

use app\models\Applicant;
use app\models\AuthItem;
use app\models\Currency;
use app\models\Employer;
use app\models\Language;
use app\models\Location;
use app\models\User;
use app\models\Vacancy;
use Faker\Factory;
use Faker\Generator;
use Yii;
use yii\console\Controller;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Demo command.
 *
 * @package app\commands
 */
class DemoController extends Controller
{
    /**
     * @var Generator[]
     */
    private $_fakerGenerators = [];

    /**
     * Generate random applicants.
     *
     * @param int $count
     */
    public function actionApplicant($count = 100)
    {
        $faker = $this->getFaker();

        for ($i = 0; $i < $count; $i++) {
            $applicant = new Applicant();
            $applicant->first_name = $faker->firstName;
            $applicant->last_name = $faker->lastName;
            $applicant->phone = $faker->phoneNumber;
            $applicant->email = $faker->email;
            $applicant->age = mt_rand(18, 80);

            $this->trySaveModel($applicant);
        }
    }

    /**
     * Generate random employers.
     *
     * @param int $count
     */
    public function actionEmployer($count = 100)
    {
        $faker = $this->getFaker();

        for ($i = 0; $i < $count; $i++) {
            $employer = new Employer();
            $employer->title = $faker->text(mt_rand(5, 32));
            $employer->description= $faker->realText(mt_rand(5, 1024));
            $employer->site_url = $faker->url;

            $this->trySaveModel($employer);
        }
    }

    /**
     * Generate random users.
     *
     * @param int $count
     */
    public function actionUser($count = 100)
    {
        $roleNames = $this->getRoleNames();

        for ($i = 0; $i < $count; $i++) {
            /** @var Language $language */
            $language = $this->getRandom(Language::className());
            $faker = $this->getFaker($language->code);

            $user = new User();
            $user->username = $faker->userName;
            $user->email = $faker->email;
            $user->first_name = $faker->firstName;
            $user->last_name = $faker->lastName;
            $user->password = 'password';
            $user->language_id = $language->id;
            $user->role = $faker->randomElement($roleNames);

            $this->trySaveModel($user);
        }
    }

    /**
     * Generate random vacancies.
     *
     * @param int $count
     */
    public function actionVacancy($count = 100)
    {
        for ($i = 0; $i < $count; $i++) {
            /** @var Language $language */
            $language = $this->getRandom(Language::className());
            $faker = $this->getFaker($language->code);

            $vacancy = new Vacancy();
            $vacancy->title = $faker->text(mt_rand(5, 32));
            $vacancy->description = $faker->realText(mt_rand(5, 1024));
            $vacancy->language_id = $language->id;
            $vacancy->location_id = $this->getRandomId(Location::className());
            $vacancy->employer_id = $this->getRandomId(Employer::className());

            $hasSalary = $faker->boolean;
            if ($hasSalary) {
                $salaryAsRange = $faker->boolean;
                if ($salaryAsRange) {
                    if ($faker->boolean) {
                        $vacancy->salary_from = $faker->randomFloat(2);
                        $vacancy->salary_to = $faker->boolean ? $faker->randomFloat(2) : null;
                    } else {
                        $vacancy->salary_from = $faker->boolean ? $faker->randomFloat(2) : null;
                        $vacancy->salary_to = $faker->randomFloat(2);
                    }
                } else {
                    $vacancy->salary_amount = $faker->randomFloat(2);
                }

                $vacancy->salary_currency_id = $this->getRandomId(Currency::className());
            }

            $this->trySaveModel($vacancy);
        }
    }

    /**
     * Try save model.
     *
     * @param ActiveRecord $model
     */
    private function trySaveModel($model)
    {
        if ($model->save()) {
            $this->stdout(sprintf("Model %s saved as %s\n", get_class($model), $model));
        } else {
            $this->stderr(sprintf("Model %s error save\n", get_class($model)));

            if ($model->hasErrors()) {
                foreach ($model->getErrors() as $attribute => $errors) {
                    foreach ($errors as $error) {
                        $this->stderr(sprintf("\t[%s]: %s\n", $attribute, $error));
                    }
                }
                $this->stderr("\n");
            }
        }
    }

    /**
     * Get faker generator instance.
     *
     * @param null $locale
     * @return Generator
     */
    private function getFaker($locale = null)
    {
        if ($locale === null) {
            $locale = Yii::$app->language;
        }

        if (!isset($this->_fakerGenerators[$locale])) {
            $this->_fakerGenerators[$locale] = Factory::create($locale);
        }

        return $this->_fakerGenerators[$locale];
    }

    /**
     * Get role names.
     *
     * @return array
     */
    private function getRoleNames()
    {
        return AuthItem::find()
            ->select('name')
            ->where(['type' => AuthItem::TYPE_ROLE])
            ->column();
    }

    /**
     * Get random model
     *
     * @param string|ActiveRecord $modelClass
     * @return array|null|ActiveRecord
     */
    private function getRandom($modelClass)
    {
        return $modelClass::find()
            ->orderBy(new Expression('rand()'))
            ->limit(1)
            ->one();

    }

    /**
     * Get random model id.
     *
     * @param string|ActiveRecord $modelClass
     * @return false|null|string
     */
    private function getRandomId($modelClass)
    {
        return $modelClass::find()
            ->select('id')
            ->orderBy(new Expression('rand()'))
            ->limit(1)
            ->scalar();
    }
}