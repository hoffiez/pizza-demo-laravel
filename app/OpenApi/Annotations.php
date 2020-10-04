<?php

/**
* @OA\Info(
*      version="1.0.0",
*      title="L5 OpenApi",
*      description="L5 Swagger OpenApi description",
*      @OA\Contact(
*          email="darius@matulionis.lt"
*      ),
*     @OA\License(
*         name="Apache 2.0",
*         url="http://www.apache.org/licenses/LICENSE-2.0.html"
*     )
* )
*/

/**
*  @OA\Server(
*      url="http://pizza.local",
*      description="L5 Swagger OpenApi dynamic host server"
*  )
*
*  @OA\Server(
*      url="https://projects.dev/api/v1",
*      description="L5 Swagger OpenApi Server"
* )
*/

/**
* @OA\SecurityScheme(
*     type="oauth2",
*     description="Use a global client_id / client_secret and your username / password combo to obtain a token",
*     name="Password Based",
*     in="header",
*     scheme="https",
*     securityScheme="Password Based",
*     @OA\Flow(
*         flow="password",
*         authorizationUrl="/oauth/authorize",
*         tokenUrl="/oauth/token",
*         refreshUrl="/oauth/token/refresh",
*         scopes={}
*     )
* )
*/

/**
* @OA\OpenApi(
*   security={
*     {
*       "oauth2": {"read:oauth2"},
*     }
*   }
* )
*/

/**
* @OA\Tag(
*     name="Products",
*     description="Everything about products",
* )
*
* @OA\Tag(
*     name="User",
*     description="Operations about user",
*     @OA\ExternalDocumentation(
*         description="Find out more about",
*         url="http://swagger.io"
*     )
* )
*/



