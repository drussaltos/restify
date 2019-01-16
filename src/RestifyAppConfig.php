<?

namespace goldencode\Bitrix\Restify;

use goldencode\Helpers\Bitrix\AppConfig;
use goldencode\Helpers\Assets;

class RestifyAppConfig extends Restify {
	/**
	 * RestifyCatalog constructor.
	 * @param array $options
	 * @throws Exception
	 */
	public function __construct(array $options) {
		parent::__construct($options);
		$this->requireModules(['catalog']);
	}


   public function prepareOutput(){
		 	$configProps = [
			'TITLE_SEP',
			'TITLE_POSTFIX',
			'YA_METRIKA_CONF',
			'SOCIALS_VK',
			'SOCIALS_TWITTER',
			'SOCIALS_FACEBOOK',
			'SOCIALS_MESSENGER',
			'SOCIALS_VIBER_MOBILE',
			'SOCIALS_VIBER_PC',
			'SOCIALS_TELEGRAM',
			'SOCIALS_INSTAGRAM',
			'INSTAGRAM_ACCESS_TOKEN',
			'INSTAGRAM_USER_ID',
			'INSTAGRAM_COUNT',
			'HOME_PAGE_SERVICE_ID',
			'PRIVACY_LINK'
		];

		$appConfig = new AppConfig(['configProps' => $configProps]);
		$plainConfig = [];

		foreach ($configProps as $prop) {
			switch ($prop) {
				case 'YA_METRIKA_CONF':
					$val = $appConfig->get($prop, '', function($v) {return json_decode($v, true);});
					break;

				default:
					$val = $appConfig->get($prop);
			}

			$plainConfig[$prop] = $val;
		}

 		return $plainConfig;
   }
}
