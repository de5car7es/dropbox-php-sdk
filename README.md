Dropbox SDK for PHP which Supports new Dropbox short lived tokens through Refresh Tokens
======================================================
Based on [**kunalvarma05 Dropbox SDK (v2)**](https://github.com/kunalvarma05/dropbox-php-sdk/).

Added suuport for Dropbox Short Lived Tokens as described in this article
https://dropbox.tech/developers/migrating-app-permissions-and-access-tokens

DropboxAuthHelper has a new method called setAccessTokenType where you can choose access token DropboxAuthHelper::TOKEN_ACCESS_TYPE_OFFLINE (default) or DropboxAuthHelper::TOKEN_ACCESS_TYPE_OFFLINE.

When access token type is set to OFFLINE, calling getAuthUrl will request access token for offline use.

When AuthHelper method getAccessToken is called, two new fields are returned in AccessToken object: $refreshToken and $tokenExpiresIn

DropboxAuthHelper method getAccessToken has a new parameter grantType which receive either a DropboxAuthHelper::GRANT_TYPE_AUTHORIZATION_CODE (default for regular tokens) or DropboxAuthHelper::GRANT_TYPE_REFRESH_TOKEN (for tokens based on refresh token).

If grant type is GRANT_TYPE_REFRESH_TOKEN and valid refresh token given in code parameter, the result is an newly and valid token that can be used.

Examples:
Getting auth URL with access token for OFFLINE use

        $authHelper = $dropboxClient->getAuthHelper();
        $authHelper->setAccessTokenType(Dropbox\Authentication\DropboxAuthHelper::TOKEN_ACCESS_TYPE_OFFLINE);
        echo $authHelper->getAuthUrl();

After that, getting access token is performed regularly:

        $authHelper = $dropboxClient->getAuthHelper();

        var_dump($authHelper->getAccessToken($key));
The result AccessToken object will contain $refreshToken and $tokenExpiresIn properties.

Getting a new token based on refresh token:

    /**
     * @param string $refreshToken   The refresh token received by AuthHelper->getAccessToken
     * @return Dropbox\Models\AccessToken
     */
    public function refreshAccessToken($refreshToken) {
        $authHelper = $dropboxClient->getAuthHelper();

        return $authHelper->getAccessToken($refreshToken, null, null, Dropbox\Authentication\DropboxAuthHelper::GRANT_TYPE_REFRESH_TOKEN);
    }
    
    
