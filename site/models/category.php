<?php
defined('_JEXEC') or die;
use Joomla\Registry\Registry;
class FoodmenuModelCategory extends JModelList
{
    public function __construct($config = array())
    {
    if (empty($config['filter_fields']))
    {
    $config['filter_fields'] = array(
    'id', 'a.id',
    'title', 'a.title',
    'state', 'a.state',
    'image', 'a.image',
    'description', 'a.description',
    'price', 'a.price'
    );
    }
    parent::__construct($config);
    }
    /*protected function populateState($ordering = null, $direction = null)
        {
            $app = JFactory::getApplication('site');
            $pk  = $app->input->getInt('id');
            $this->setState('catid', $pk);
            $catid = JRequest::getInt('catid');
            // Load the parameters. Merge Global and Menu Item params into new object
		$params = $app->getParams();
                
		$menuParams = new Registry;

		if ($menu = $app->getMenu()->getActive())
		{
			$menuParams->loadString($menu->params);
		}

		$mergedParams = clone $menuParams;
		$mergedParams->merge($params);

		$this->setState('params', $mergedParams);
                $this->setState('filter.language', JLanguageMultilang::isEnabled());

        
        }*/
    protected function getListQuery()
    {
    $db = $this->getDbo();
    $query = $db->getQuery(true);
    $query->select(
    $this->getState(
    'list.select',
    'a.id, a.title,' .
    ' a.description,' .
     ' a.image, a.price'
    )
    );
    $query->from($db->quoteName('#__foodmenu').' AS a');
    $query->where('(a.state IN (0, 1))');
    if ($categoryId = $this->getState('category.id')){
    $query->where('a.catid = ' . (int) $categoryId);
    }
    
   
    // Filter by language
		if ($this->getState('filter.language'))
		{
			$query->where('a.language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')');
		}
                return $query;
                 }
   public function getItems()
	{
		// Invoke the parent getItems method to get the main list
		$items = parent::getItems();

		// Convert the params field into an object, saving original in _params
		foreach ($items as $item)
		{
			if (!isset($this->_params))
			{
				$params = new Registry;
				$params->loadString($item->params);
				$item->params = $params;
			}
		}

		return $items;
	}
        
   /*public function getCategory()
	{
       
		if (!is_object($this->_item))
		{
			

			$categories = JCategories::getInstance('Foodmenu');
                        var_dump($categories);
			$this->_item = $categories->get($this->getState('category.id', 'root'));
                        
			// Compute selected asset permissions.
			if (is_object($this->_item))
			{

				// TODO: Why aren't we lazy loading the children and siblings?
				$this->_children = $this->_item->getChildren();
				$this->_parent = false;

				if ($this->_item->getParent())
				{
					$this->_parent = $this->_item->getParent();
				}

				$this->_rightsibling = $this->_item->getSibling();
				$this->_leftsibling = $this->_item->getSibling(false);
			}
			else
			{
				$this->_children = false;
				$this->_parent = false;
			}
		}

		return $this->_item;
	}*/
        public function getCategory()
	{
		if (!is_object($this->_item))
		{

			$categories = JCategories::getInstance('Foodmenu');
                        
			$this->_item = $categories->get($this->getState('category.id', 'root'));

			// Compute selected asset permissions.
			if (is_object($this->_item))
			{
				// TODO: Why aren't we lazy loading the children and siblings?
				$this->_children = $this->_item->getChildren();
				$this->_parent = false;
                               
				if ($this->_item->getParent())
				{
					$this->_parent = $this->_item->getParent();
				}

				$this->_rightsibling = $this->_item->getSibling();
				$this->_leftsibling = $this->_item->getSibling(false);
			}
			else
			{
				$this->_children = false;
				$this->_parent = false;
			}
		}
                
		return $this->_item;
	}
        
        public function getParent()
	{
		if (!is_object($this->_item))
		{
			$this->getCategory();
		}
                
		return $this->_parent;
	}
        
        
        protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('site');
		$pk  = $app->input->getInt('id');

		$this->setState('category.id', $pk);

		// Load the parameters. Merge Global and Menu Item params into new object
		$params = $app->getParams();
		$menuParams = new Registry;

		if ($menu = $app->getMenu()->getActive())
		{
			$menuParams->loadString($menu->params);
		}

		$mergedParams = clone $menuParams;
		$mergedParams->merge($params);

		$this->setState('params', $mergedParams);
		$user  = JFactory::getUser();

		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$asset = 'com_foodmenu';

		if ($pk)
		{
			$asset .= '.category.' . $pk;
		}

		
			$this->setState('filter.published', array(0, 1, 2));
		


		$this->setState('filter.language', JLanguageMultilang::isEnabled());

		$this->setState('layout', $app->input->getString('layout'));

	}
        
}
