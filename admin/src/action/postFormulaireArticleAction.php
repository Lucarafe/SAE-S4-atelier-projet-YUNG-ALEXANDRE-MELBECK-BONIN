<?php
namespace MiniPress\app\action;
use MiniPress\app\service\article\ArticleService;
use Slim\Routing\RouteContext;

class postFormulaireArticleAction
{
    public function __invoke($request, $response, $args)
    {
        $article = $request->getParsedBody();
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();
        if(isset($_SESSION['user'])){
            $auteur = $_SESSION['user']->login;
        }else{
            $auteur = "Anonyme";
        }
        $articleData = [
            'titre' => $article['titre'],
            'resume' => $article['resume'],
            'contenu' => $article['contenu'],
            'categorie' => $article['categorie'],
            'auteur' => $auteur,
        ];

        $articleService = new ArticleService();
        $articleService->addArticle($articleData);

        return $response->withStatus(302)->withHeader('Location', $routeParser->urlFor('articles'));
        
    }
}