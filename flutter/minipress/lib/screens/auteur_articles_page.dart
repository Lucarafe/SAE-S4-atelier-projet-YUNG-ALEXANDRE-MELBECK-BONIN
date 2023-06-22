import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/article.dart';
import '../providers/article_provider.dart';
import 'article_filter_page.dart';
import 'article_page.dart';
import 'package:provider/provider.dart';

class AuthorArticlesPage extends StatefulWidget {
  final Article article;

  const AuthorArticlesPage({
    required this.article,
  });

  @override
  _AuthorArticlesPageState createState() => _AuthorArticlesPageState();
}

class _AuthorArticlesPageState extends State<AuthorArticlesPage> {
  @override
  void initState() {
    super.initState();
    Provider.of<ArticleProvider>(context, listen: false)
        .fetchAuteurArticles(widget.article.hrefAuteur);
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<ArticleProvider>(
      builder: (context, articleProvider, _) {
        return Scaffold(
          appBar: AppBar(
            title: Row(
              children: [
                Flexible(
                  child: IconButton(
                    icon: Icon(Icons.search),
                    onPressed: () {
                      showSearch(
                        context: context,
                        delegate: ArticleSearchDelegate(
                          articleProvider.filteredArticles,
                        ),
                      );
                    },
                    tooltip: 'Rechercher',
                  ),
                ),
                Text('Articles de ${widget.article.auteur}'),
              ],
            ),
          ),
          body: ListView.builder(
            itemCount: articleProvider.filteredArticles.length,
            itemBuilder: (context, index) {
              final article = articleProvider.filteredArticles[index];
              return ListTile(
                title: Text(article.titre),
                subtitle: Text(
                    'Auteur: ${article.auteur} | Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}'),
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => ArticlePage(article: article),
                    ),
                  );
                },
              );
            },
          ),
        );
      },
    );
  }
}
