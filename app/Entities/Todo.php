<?php
namespace App\Entities;

use Luxid\Database\DbEntity;

class Todo extends DbEntity
{
    public int $id = 0;
    public string $title = '';
    public string $description = '';
    public string $status = 'pending';  // pending, in_progress, completed
    public string $created_at = '';
    public string $updated_at = '';

    public static function tableName(): string
    {
        return 'todos';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return [
            'title',
            'description',
            'status',
            'created_at',
            'updated_at'
        ];
    }

    public function rules(): array
    {
        return [
           'title' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 3],
                [self::RULE_MAX, 'max' => 255]
           ],
           'description' => [
                [self::RULE_MAX, 'max' => 255]
           ],
           'status' => [
                self::RULE_REQUIRED
           ]
        ];
    }

    public function save(): bool
    {
        if ($this->id === 0) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');
        return parent::save();
    }

    /**
     * Custom validation for status field
     */
    public function validate(): bool
    {
        $statusOptions = ['pending', 'in_progress', 'completed'];

        if (!in_array($this->status, $statusOptions)) {
            $this->addError('status', 'Status must be one of: ' . implode(', ', $statusOptions));
        }

        return parent::validate();
    }

    /**
     * Helper method to format data for API response
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

/**
 * Explanation:
 *      - DbEntity         ===        provides Active Record pattern - your model represents a database table
 *      - tableName()   ===        tells Luxid which table to use
 *      - attributes()      ===       defines which columns map to object properties
 *      - rules()             ===        provides validation rules
 *      - save()             ===        automatically handles timestamps before saving
 */
