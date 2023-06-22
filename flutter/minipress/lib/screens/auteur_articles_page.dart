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
            backgroundColor: Colors.grey[800],
            title: Row(
              children: [
                Flexible(
                  child: IconButton(
                    icon: Icon(Icons.search),
                    color: Colors.white,
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
                Text(
                  'Articles de ${widget.article.auteur}',
                  style: TextStyle(
                    color: Colors.white,
                  ),
                ),
              ],
            ),
          ),
          body: ListView.builder(
            itemCount: articleProvider.filteredArticles.length,
            itemBuilder: (context, index) {
              final article = articleProvider.filteredArticles[index];
              return Card(
                elevation: 2,
                margin: EdgeInsets.symmetric(vertical: 8, horizontal: 16),
                child: ListTile(
                  title: Text(
                    article.titre,
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  subtitle: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      SizedBox(height: 4),
                      Text(
                        'Auteur: ${article.auteur}',
                        style: TextStyle(
                          color: Colors.grey[700],
                        ),
                      ),
                      SizedBox(height: 2),
                      Text(
                        'Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}',
                        style: TextStyle(
                          color: Colors.grey[700],
                        ),
                      ),
                      SizedBox(height: 4),
                    ],
                  ),
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => ArticlePage(article: article),
                      ),
                    );
                  },
                ),
              );
            },
          ),
        );
      },
    );
  }
}
