<?php
namespace Flowpack\SingleSignOn\Client\Security\RequestPattern;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Flowpack.SingleSignOn.Client".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Resolve public keys of an SsoServer
 *
 * This resolver expects a public key fingerprint of an SSO server and
 * will return the same fingerprint if a server is registered with that fingerprint.
 */
class SsoServerPublicKeyResolver implements \Flowpack\SingleSignOn\Client\Security\PublicKeyResolverInterface {

	/**
	 * @Flow\Inject
	 * @var \Flowpack\SingleSignOn\Client\Domain\Repository\SsoServerRepository
	 */
	protected $ssoServerRepository;

	/**
	 * @param string $identifier The identifier for looking up the public key
	 * @return string The public key fingerprint or NULL if no public key was found for the identifier
	 */
	public function resolveFingerprintByIdentifier($identifier) {
		$ssoServer = $this->ssoServerRepository->findByPublicKey($identifier);
		if ($ssoServer instanceof \Flowpack\SingleSignOn\Client\Domain\Model\SsoServer) {
			return $ssoServer->getPublicKey();
		}
		return NULL;
	}

}
?>