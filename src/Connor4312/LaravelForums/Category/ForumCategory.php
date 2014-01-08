<?php namespace Connor4312\LaravelForums;

class ForumCategory implements TopicQueryBuilderInterface {

	/**
	 * Holds the Eloquent object while the topic is being retrieved.
	 * 
	 * @var \Illuminate\Database\Query\Builder
	 */
	protected $query;

	/**
	 * Creates the join base 
	 */
	public function __construct() {
		$this->query = Topic::join();
	}

	/**
	 * Gets a list of all categories of the given parent, including
	 * the most recently updated topic (in $category->topic)
	 * 
	 * @param $parent integer
	 * @param $include_recent boolean
	 * 
	 * @return stdclass
	 */
	public static function getList($parent = -1, $include_recent = true) {

		if (is_object($parent)) $parent = $parent->id

		$cats = Category::where('parent_id', $parent)->get();

		$tops = self::getRecentForCategoryQuery(Category::where('parent_id', $parent));
		
		foreach ($cats as $cat) {
			foreach ($tops as $top) {
				if ($top->parent_id == $cat->id) {
					$cat->topic = $top;
					break;
				}
			}
		}
	}

	/**
	 * Modifies a Category query to get the most recent topics.
	 * 
	 * @param \Illuminate\Database\Query\Builder $query
	 * 
	 * @return array
	 */
	public static function getRecentForCategoryQuery($query) {
		return $query->with('topics')
			->groupBy('category_id')
			->orderBy('updated_at', 'DESC')
			->get();
	}

	/**
	 * Passes unhandled methods off to the Eloquent model for the topic.
	 * 
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return self
	 */
	public function __call($method, $args) {

		$this->query = call_user_func(array($this->query, $method), $args);

		return $this;
	}
}