<?php
namespace MiniPress\app\action;
use MiniPress\app\service\ArticleService;
use Slim\Routing\RouteContext;

class postFormulaireArticleAction
{
    public function __invoke($request, $response, $args)
    {
        $article = $request->getParsedBody();
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();
        $articleData = [
            'titre' => $article['titre'],
            'resume' => $article['resume'],
            'contenu' => $article['contenu'],
            'categorie' => $article['categorie'],
        ];

        $articleService = new ArticleService();
        $articleService->addArticle($articleData);

        return $response->withStatus(302)->withHeader('Location', $routeParser->urlFor('articles'));
        
    }
}