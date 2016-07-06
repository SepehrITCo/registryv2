<?php 

	/**
	 * Assign high numeric IDs to a config item to force appending.
	 *
	 * @param  array  $array
	 * @return array
	 */
	function append_config(array $array)
	{
		$start = 9999;
		foreach ($array as $key => $value)
		{
			if (is_numeric($key))
			{
				$start++;
				$array[$start] = array_pull($array, $key);
			}
		}
		return $array;
	}

	/**
	 * Add an element to an array using "dot" notation if it doesn't exist.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return array
	 */
	function array_add($array, $key, $value)
	{
		if (is_null(get($array, $key)))
		{
			set($array, $key, $value);
		}
		return $array;
	}

	/**
	 * Build a new array using a callback.
	 *
	 * @param  array     $array
	 * @param  \Closure  $callback
	 * @return array
	 */
	function array_build($array, Closure $callback)
	{
		$results = array();
		foreach ($array as $key => $value)
		{
			list($innerKey, $innerValue) = call_user_func($callback, $key, $value);
			$results[$innerKey] = $innerValue;
		}
		return $results;
	}

	/**
	 * Divide an array into two arrays. One with keys and the other with values.
	 *
	 * @param  array  $array
	 * @return array
	 */
	function array_divide($array)
	{
		return array(array_keys($array), array_values($array));
	}

	/**
	 * Flatten a multi-dimensional associative array with dots.
	 *
	 * @param  array   $array
	 * @param  string  $prepend
	 * @return array
	 */
	function array_dot($array, $prepend = '')
	{
		$results = array();
		foreach ($array as $key => $value)
		{
			if (is_array($value))
			{
				$results = array_merge($results, dot($value, $prepend.$key.'.'));
			}
			else
			{
				$results[$prepend.$key] = $value;
			}
		}
		return $results;
	}

	/**
	 * Get all of the given array except for a specified array of items.
	 *
	 * @param  array  $array
	 * @param  array|string  $keys
	 * @return array
	 */
	function array_except($array, $keys)
	{
		return array_diff_key($array, array_flip((array) $keys));
	}

	/**
	 * Fetch a flattened array of a nested array element.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @return array
	 */
	function array_fetch($array, $key)
	{
		$results = array();
		foreach (explode('.', $key) as $segment)
		{
			foreach ($array as $value)
			{
				if (array_key_exists($segment, $value = (array) $value))
				{
					$results[] = $value[$segment];
				}
			}
			$array = array_values($results);
		}
		return array_values($results);
	}

	/**
	 * Return the first element in an array passing a given truth test.
	 *
	 * @param  array     $array
	 * @param  \Closure  $callback
	 * @param  mixed     $default
	 * @return mixed
	 */
	function array_first($array, $callback, $default = null)
	{
		foreach ($array as $key => $value)
		{
			if (call_user_func($callback, $key, $value)) return $value;
		}
		return value($default);
	}

	/**
	 * Return the last element in an array passing a given truth test.
	 *
	 * @param  array     $array
	 * @param  \Closure  $callback
	 * @param  mixed     $default
	 * @return mixed
	 */
	function array_last($array, $callback, $default = null)
	{
		return first(array_reverse($array), $callback, $default);
	}

	/**
	 * Flatten a multi-dimensional array into a single level.
	 *
	 * @param  array  $array
	 * @return array
	 */
	function array_flatten($array)
	{
		$return = array();
		array_walk_recursive($array, function($x) use (&$return) { $return[] = $x; });
		return $return;
	}

	/**
	 * Remove one or many array items from a given array using "dot" notation.
	 *
	 * @param  array  $array
	 * @param  array|string  $keys
	 * @return void
	 */
	function array_forget(&$array, $keys)
	{
		$original =& $array;
		foreach ((array) $keys as $key)
		{
			$parts = explode('.', $key);
			while (count($parts) > 1)
			{
				$part = array_shift($parts);
				if (isset($array[$part]) && is_array($array[$part]))
				{
					$array =& $array[$part];
				}
			}
			unset($array[array_shift($parts)]);
			// clean up after each pass
			$array =& $original;
		}
	}

	/**
	 * Get an item from an array using "dot" notation.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return mixed
	 */
	function array_get($array, $key, $default = null)
	{
		if (is_null($key)) return $array;
		if (isset($array[$key])) return $array[$key];
		foreach (explode('.', $key) as $segment)
		{
			if ( ! is_array($array) || ! array_key_exists($segment, $array))
			{
				return value($default);
			}
			$array = $array[$segment];
		}
		return $array;
	}

	/**
	 * Check if an item exists in an array using "dot" notation.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @return bool
	 */
	function array_has($array, $key)
	{
		if (empty($array) || is_null($key)) return false;
		if (array_key_exists($key, $array)) return true;
		foreach (explode('.', $key) as $segment)
		{
			if ( ! is_array($array) || ! array_key_exists($segment, $array))
			{
				return false;
			}
			$array = $array[$segment];
		}
		return true;
	}

	/**
	 * Get a subset of the items from the given array.
	 *
	 * @param  array  $array
	 * @param  array|string  $keys
	 * @return array
	 */
	function array_only($array, $keys)
	{
		return array_intersect_key($array, array_flip((array) $keys));
	}

	/**
	 * Pluck an array of values from an array.
	 *
	 * @param  array   $array
	 * @param  string  $value
	 * @param  string  $key
	 * @return array
	 */
	function array_pluck($array, $value, $key = null)
	{
		$results = array();
		foreach ($array as $item)
		{
			$itemValue = data_get($item, $value);
			// If the key is "null", we will just append the value to the array and keep
			// looping. Otherwise we will key the array using the value of the key we
			// received from the developer. Then we'll return the final array form.
			if (is_null($key))
			{
				$results[] = $itemValue;
			}
			else
			{
				$itemKey = data_get($item, $key);
				$results[$itemKey] = $itemValue;
			}
		}
		return $results;
	}

	/**
	 * Get a value from the array, and remove it.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return mixed
	 */
	function array_pull(&$array, $key, $default = null)
	{
		$value = get($array, $key, $default);
		forget($array, $key);
		return $value;
	}

	/**
	 * Set an array item to a given value using "dot" notation.
	 *
	 * If no key is given to the method, the entire array will be replaced.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return array
	 */
	function array_set(&$array, $key, $value)
	{
		if (is_null($key)) return $array = $value;
		$keys = explode('.', $key);
		while (count($keys) > 1)
		{
			$key = array_shift($keys);
			// If the key doesn't exist at this depth, we will just create an empty array
			// to hold the next value, allowing us to create the arrays to hold final
			// values at the correct depth. Then we'll keep digging into the array.
			if ( ! isset($array[$key]) || ! is_array($array[$key]))
			{
				$array[$key] = array();
			}
			$array =& $array[$key];
		}
		$array[array_shift($keys)] = $value;
		return $array;
	}

	/**
	 * Filter the array using the given Closure.
	 *
	 * @param  array     $array
	 * @param  \Closure  $callback
	 * @return array
	 */
	function array_where($array, Closure $callback)
	{
		$filtered = array();
		foreach ($array as $key => $value)
		{
			if (call_user_func($callback, $key, $value)) $filtered[$key] = $value;
		}
		return $filtered;
	}

	/**
	 * Convert a value to camel case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function camel_case($value)
	{
		$camelCache = [];
		if (isset($camelCache[$value]))
		{
			return $camelCache[$value];
		}
		return $camelCache[$value] = lcfirst(studly($value));
	}

	/**
	 * Get the class "basename" of the given object / class.
	 *
	 * @param  string|object  $class
	 * @return string
	 */
	function class_basename($class)
	{
		$class = is_object($class) ? get_class($class) : $class;
		return basename(str_replace('\\', '/', $class));
	}

	/**
	 * Returns all traits used by a class, it's subclasses and trait of their traits
	 *
	 * @param  string  $class
	 * @return array
	 */
	function class_uses_recursive($class)
	{
		$results = [];
		foreach (array_merge([$class => $class], class_parents($class)) as $class)
		{
			$results += trait_uses_recursive($class);
		}
		return array_unique($results);
	}

	/**
	 * Get an item from an array or object using "dot" notation.
	 *
	 * @param  mixed   $target
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return mixed
	 */
	function data_get($target, $key, $default = null)
	{
		if (is_null($key)) return $target;
		foreach (explode('.', $key) as $segment)
		{
			if (is_array($target))
			{
				if ( ! array_key_exists($segment, $target))
				{
					return value($default);
				}
				$target = $target[$segment];
			}
			elseif ($target instanceof ArrayAccess)
			{
				if ( ! isset($target[$segment]))
				{
					return value($default);
				}
				$target = $target[$segment];
			}
			elseif (is_object($target))
			{
				if ( ! isset($target->{$segment}))
				{
					return value($default);
				}
				$target = $target->{$segment};
			}
			else
			{
				return value($default);
			}
		}
		return $target;
	}

	/**
	 * Escape HTML entities in a string.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function e($value)
	{
		return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
	}

	/**
	 * Determine if a given string ends with a given substring.
	 *
	 * @param  string  $haystack
	 * @param  string|array  $needles
	 * @return bool
	 */
	function ends_with($haystack, $needles)
	{
		foreach ((array) $needles as $needle)
		{
			if ((string) $needle === substr($haystack, -strlen($needle))) return true;
		}
		return false;
	}

	/**
	 * Get the first element of an array. Useful for method chaining.
	 *
	 * @param  array  $array
	 * @return mixed
	 */
	function head($array)
	{
		return reset($array);
	}

	/**
	 * Get the last element from an array.
	 *
	 * @param  array  $array
	 * @return mixed
	 */
	function last($array)
	{
		return end($array);
	}

	/**
	 * Get an item from an object using "dot" notation.
	 *
	 * @param  object  $object
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return mixed
	 */
	function object_get($object, $key, $default = null)
	{
		if (is_null($key) || trim($key) == '') return $object;
		foreach (explode('.', $key) as $segment)
		{
			if ( ! is_object($object) || ! isset($object->{$segment}))
			{
				return value($default);
			}
			$object = $object->{$segment};
		}
		return $object;
	}

	/**
	 * Replace a given pattern with each value in the array in sequentially.
	 *
	 * @param  string  $pattern
	 * @param  array   $replacements
	 * @param  string  $subject
	 * @return string
	 */
	function preg_replace_sub($pattern, &$replacements, $subject)
	{
		return preg_replace_callback($pattern, function() use (&$replacements)
		{
			return array_shift($replacements);
		}, $subject);
	}

	/**
	 * Convert a string to snake case.
	 *
	 * @param  string  $value
	 * @param  string  $delimiter
	 * @return string
	 */
	function snake_case($value, $delimiter = '_')
	{
		$snakeCache = [];
		$key = $value.$delimiter;
		if (isset($snakeCache[$key]))
		{
			return $snakeCache[$key];
		}
		if ( ! ctype_lower($value))
		{
			$value = strtolower(preg_replace('/(.)(?=[A-Z])/', '$1'.$delimiter, $value));
		}
		return $snakeCache[$key] = $value;
	}

	/**
	 * Determine if a given string starts with a given substring.
	 *
	 * @param  string  $haystack
	 * @param  string|array  $needles
	 * @return bool
	 */
	function starts_with($haystack, $needles)
	{
		foreach ((array) $needles as $needle)
		{
			if ($needle != '' && strpos($haystack, $needle) === 0) return true;
		}
		return false;
	}

	/**
	 * Determine if a given string contains a given substring.
	 *
	 * @param  string  $haystack
	 * @param  string|array  $needles
	 * @return bool
	 */
	function str_contains($haystack, $needles)
	{
		foreach ((array) $needles as $needle)
		{
			if ($needle != '' && strpos($haystack, $needle) !== false) return true;
		}
		return false;
	}

	/**
	 * Cap a string with a single instance of a given value.
	 *
	 * @param  string  $value
	 * @param  string  $cap
	 * @return string
	 */
	function str_finish($value, $cap)
	{
		$quoted = preg_quote($cap, '/');
		return preg_replace('/(?:'.$quoted.')+$/', '', $value).$cap;
	}

	/**
	 * Determine if a given string matches a given pattern.
	 *
	 * @param  string  $pattern
	 * @param  string  $value
	 * @return bool
	 */
	function str_is($pattern, $value)
	{
		if ($pattern == $value) return true;
		$pattern = preg_quote($pattern, '#');
		// Asterisks are translated into zero-or-more regular expression wildcards
		// to make it convenient to check if the strings starts with the given
		// pattern such as "library/*", making any string check convenient.
		$pattern = str_replace('\*', '.*', $pattern).'\z';
		return (bool) preg_match('#^'.$pattern.'#', $value);
	}

	/**
	 * Limit the number of characters in a string.
	 *
	 * @param  string  $value
	 * @param  int     $limit
	 * @param  string  $end
	 * @return string
	 */
	function str_limit($value, $limit = 100, $end = '...')
	{
		if (mb_strlen($value) <= $limit) return $value;
		return rtrim(mb_substr($value, 0, $limit, 'UTF-8')).$end;
	}

	/**
	 * Generate a more truly "random" alpha-numeric string.
	 *
	 * @param  int  $length
	 * @return string
	 *
	 * @throws \RuntimeException
	 */
	function str_random($length = 16)
	{
		if ( ! function_exists('openssl_random_pseudo_bytes'))
		{
			throw new RuntimeException('OpenSSL extension is required.');
		}
		$bytes = openssl_random_pseudo_bytes($length * 2);
		if ($bytes === false)
		{
			throw new RuntimeException('Unable to generate random string.');
		}
		return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
	}

	/**
	 * Replace a given value in the string sequentially with an array.
	 *
	 * @param  string  $search
	 * @param  array   $replace
	 * @param  string  $subject
	 * @return string
	 */
	function str_replace_array($search, array $replace, $subject)
	{
		foreach ($replace as $value)
		{
			$subject = preg_replace('/'.$search.'/', $value, $subject, 1);
		}
		return $subject;
	}

	/**
	 * Convert a value to studly caps case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function studly_case($value)
	{
		$studlyCache = [];
		$key = $value;
		if (isset($studlyCache[$key]))
		{
			return $studlyCache[$key];
		}
		$value = ucwords(str_replace(array('-', '_'), ' ', $value));
		return $studlyCache[$key] = str_replace(' ', '', $value);
	}

	/**
	 * Returns all traits used by a trait and its traits
	 *
	 * @param  string  $trait
	 * @return array
	 */
	function trait_uses_recursive($trait)
	{
		$traits = class_uses($trait);
		foreach ($traits as $trait)
		{
			$traits += trait_uses_recursive($trait);
		}
		return $traits;
	}

	/**
	 * Return the default value of the given value.
	 *
	 * @param  mixed  $value
	 * @return mixed
	 */
	function value($value)
	{
		return $value instanceof Closure ? $value() : $value;
	}

	/**
	 * Return the given object. Useful for chaining.
	 *
	 * @param  mixed  $object
	 * @return mixed
	 */
	function with($object)
	{
		return $object;
	}

	/**
	 * Convert a value to studly caps case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function studly($value)
	{
		$studlyCache = [];
		$key = $value;
		if (isset($studlyCache[$key]))
		{
			return $studlyCache[$key];
		}
		$value = ucwords(str_replace(array('-', '_'), ' ', $value));
		return $studlyCache[$key] = str_replace(' ', '', $value);
	}

	/**
	 * Get an item from an array using "dot" notation.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return mixed
	 */
	function get($array, $key, $default = null)
	{
		if (is_null($key)) return $array;
		if (isset($array[$key])) return $array[$key];
		foreach (explode('.', $key) as $segment)
		{
			if ( ! is_array($array) || ! array_key_exists($segment, $array))
			{
				return value($default);
			}
			$array = $array[$segment];
		}
		return $array;
	}

	/**
	 * Set an array item to a given value using "dot" notation.
	 *
	 * If no key is given to the method, the entire array will be replaced.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return array
	 */
	function set(&$array, $key, $value)
	{
		if (is_null($key)) return $array = $value;
		$keys = explode('.', $key);
		while (count($keys) > 1)
		{
			$key = array_shift($keys);
			// If the key doesn't exist at this depth, we will just create an empty array
			// to hold the next value, allowing us to create the arrays to hold final
			// values at the correct depth. Then we'll keep digging into the array.
			if ( ! isset($array[$key]) || ! is_array($array[$key]))
			{
				$array[$key] = array();
			}
			$array =& $array[$key];
		}
		$array[array_shift($keys)] = $value;
		return $array;
	}

	/**
	 * Flatten a multi-dimensional associative array with dots.
	 *
	 * @param  array   $array
	 * @param  string  $prepend
	 * @return array
	 */
	function dot($array, $prepend = '')
	{
		$results = array();
		foreach ($array as $key => $value)
		{
			if (is_array($value))
			{
				$results = array_merge($results, dot($value, $prepend.$key.'.'));
			}
			else
			{
				$results[$prepend.$key] = $value;
			}
		}
		return $results;
	}

	/**
	 * Return the first element in an array passing a given truth test.
	 *
	 * @param  array     $array
	 * @param  \Closure  $callback
	 * @param  mixed     $default
	 * @return mixed
	 */
	function first($array, $callback, $default = null)
	{
		foreach ($array as $key => $value)
		{
			if (call_user_func($callback, $key, $value)) return $value;
		}
		return value($default);
	}

	/**
	 * Remove one or many array items from a given array using "dot" notation.
	 *
	 * @param  array  $array
	 * @param  array|string  $keys
	 * @return void
	 */
	function forget(&$array, $keys)
	{
		$original =& $array;
		foreach ((array) $keys as $key)
		{
			$parts = explode('.', $key);
			while (count($parts) > 1)
			{
				$part = array_shift($parts);
				if (isset($array[$part]) && is_array($array[$part]))
				{
					$array =& $array[$part];
				}
			}
			unset($array[array_shift($parts)]);
			// clean up after each pass
			$array =& $original;
		}
	}
