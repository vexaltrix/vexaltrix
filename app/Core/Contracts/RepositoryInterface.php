<?php
/**
 * Repository interface — base contract for data access.
 *
 * @package Vexaltrix\Core\Contracts
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Core\Contracts;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base contract for data access.
 * Implementations may wrap WP options, custom tables, REST APIs, etc.
 *
 * @template T
 * @since x.x.x
 */
interface RepositoryInterface {

	/**
	 * Find an entity by ID.
	 *
	 * @param string $id Entity identifier.
	 * @return mixed The entity or null.
	 */
	public function find( string $id ): mixed;

	/**
	 * Find entities matching criteria.
	 *
	 * @param array<string, mixed> $criteria Search criteria.
	 * @return array<int, mixed> List of matching entities.
	 */
	public function findBy( array $criteria = [] ): array;

	/**
	 * Persist an entity.
	 *
	 * @param mixed $entity The entity to save.
	 * @return bool True on success.
	 */
	public function save( mixed $entity ): bool;

	/**
	 * Delete an entity by ID.
	 *
	 * @param string $id Entity identifier.
	 * @return bool True on success.
	 */
	public function delete( string $id ): bool;

	/**
	 * Check if an entity exists.
	 *
	 * @param string $id Entity identifier.
	 * @return bool
	 */
	public function exists( string $id ): bool;
}
