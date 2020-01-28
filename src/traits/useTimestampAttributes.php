<?php

namespace SobreFramework\Core\Traits;

/**
 * Trait useTimestampAttributes
 * @package SobreFramework\Core\Traits
 */
trait useTimestampAttributes
{
    protected
        /** @var int The timestamp when the element was created. */
        $created_at,
        /** @var int|null The ID of the user who created the element. */
        $created_by,
        /** @var int|null The timestamp when the element was last updated. */
        $updated_at,
        /** @var int|null The ID of the user who last updated the element. */
        $updated_by;

    /**
     * Get the timestamp when the element was created.
     *
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    /**
     * Set the timestamp when the element was created. If null, the current timestamp will be saved into the DB.
     *
     * @param int|null $created_at
     * @return $this
     */
    public function setCreatedAt(?int $created_at = null): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the ID of the user who created the element or null if that's not a user.
     *
     * @return int|null
     */
    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    /**
     * Set the ID of the user who created the element or null if that's not a user.
     *
     * @param int|null $created_by
     * @return $this
     */
    public function setCreatedBy(?int $created_by = null): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * Get the timestamp when the element was last updated or null if never updated yet.
     *
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->updated_at;
    }

    /**
     * Set the timestamp when the element was last updated or null if never updated yet.
     *
     * @param int|null $updated_at
     * @return $this
     */
    public function setUpdatedAt(?int $updated_at = null): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the ID of the user who last updated the element or null if that's not an user.
     *
     * @return int|null
     */
    public function getUpdatedBy(): ?int
    {
        return $this->updated_by;
    }

    /**
     * Set the ID of the user who last updated the element or null if that's not an user.
     *
     * @param int|null $updated_by
     * @return $this
     */
    public function setUpdatedBy(?int $updated_by = null): self
    {
        $this->updated_by = $updated_by;

        return $this;
    }
}
