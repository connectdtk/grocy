<?php

namespace Grocy\Controllers;

use \Grocy\Services\DatabaseService;
use \Grocy\Services\ApplicationService;
use \Grocy\Services\LocalizationService;

class BaseController
{
	public function __construct(\Slim\Container $container) {
		$databaseService = new DatabaseService();
		$this->Database = $databaseService->GetDbConnection();

		$applicationService = new ApplicationService();
		$container->view->set('version', $applicationService->GetInstalledVersion());

		$localizationService = new LocalizationService(CULTURE);
		$container->view->set('localizationStrings', $localizationService->GetCurrentCultureLocalizations());
		$container->view->set('L', function($text, ...$placeholderValues) use($localizationService)
		{
			return $localizationService->Localize($text, ...$placeholderValues);
		});
		$container->view->set('U', function($relativePath) use($container)
		{
			return $container->UrlManager->ConstructUrl($relativePath);
		});

		$this->AppContainer = $container;
	}

	protected $AppContainer;
	protected $Database;
}
