<?php
declare(strict_types=1);

namespace Admins\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailTemplates Model
 *
 * @method \Admins\Model\Entity\EmailTemplate newEmptyEntity()
 * @method \Admins\Model\Entity\EmailTemplate newEntity(array $data, array $options = [])
 * @method \Admins\Model\Entity\EmailTemplate[] newEntities(array $data, array $options = [])
 * @method \Admins\Model\Entity\EmailTemplate get($primaryKey, $options = [])
 * @method \Admins\Model\Entity\EmailTemplate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Admins\Model\Entity\EmailTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admins\Model\Entity\EmailTemplate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Admins\Model\Entity\EmailTemplate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\EmailTemplate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\EmailTemplate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\EmailTemplate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\EmailTemplate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\EmailTemplate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailTemplatesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('email_templates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('email_template_title')
            ->maxLength('email_template_title', 255)
            ->allowEmptyString('email_template_title');

        $validator
            ->scalar('email_template_sender_name')
            ->allowEmptyString('email_template_sender_name');

        $validator
            ->scalar('email_template_sender_email_address')
            ->maxLength('email_template_sender_email_address', 255)
            ->allowEmptyString('email_template_sender_email_address');

        $validator
            ->scalar('email_template_email_address')
            ->maxLength('email_template_email_address', 255)
            ->allowEmptyString('email_template_email_address');

        $validator
            ->scalar('email_template_email_heading')
            ->maxLength('email_template_email_heading', 255)
            ->allowEmptyString('email_template_email_heading');

        $validator
            ->scalar('email_template_email_from')
            ->allowEmptyString('email_template_email_from');

        $validator
            ->scalar('email_template_subject')
            ->allowEmptyString('email_template_subject');

        $validator
            ->scalar('email_template_description')
            ->allowEmptyString('email_template_description');

        $validator
            ->scalar('email_template_support_message')
            ->allowEmptyString('email_template_support_message');

        $validator
            ->scalar('email_template_disclaimer')
            ->allowEmptyString('email_template_disclaimer');

        $validator
            ->integer('email_template_status')
            ->requirePresence('email_template_status', 'create')
            ->notEmptyString('email_template_status');

        return $validator;
    }
}
