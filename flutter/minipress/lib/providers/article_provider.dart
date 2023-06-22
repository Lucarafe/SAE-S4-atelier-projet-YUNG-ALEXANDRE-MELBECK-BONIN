import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/article.dart';
import 'api_provider.dart';

class ArticleProvider extends ChangeNotifier {
  List<Article> articles = [];
  List<Article> filteredArticles = [];
  TextEditingController searchKeywordController = TextEditingController();
  bool isDescendingOrder = true;
  String searchKeyword = '';

  Future<void> fetchArticles() async {
    final order = isDescendingOrder ? 'date-desc' : 'date-asc';
    final response = await ApiProvider.get('/api/articles?sort=$order');
    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final List<dynamic> articlesJson = data['articles'];
      articles = articlesJson.map((json) => Article.fromJson(json)).toList();
      filterArticles();
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  Future<void> fetchAuteurArticles(String hrefAuteur) async {
    final response = await ApiProvider.get(hrefAuteur);
    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final List<dynamic> articlesJson = data['articles'];
      articles = articlesJson.map((json) => Article.fromJson(json)).toList();
      filterArticles();
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  Future<void> fetchArticlesCategorie(String categoryId) async {
    final order = isDescendingOrder ? 'date-desc' : 'date-asc';
    final response =
        await ApiProvider.get('/api/categories/$categoryId/articles?sort=$order');

    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final dynamic articlesJson = data['articles'];

      if (articlesJson is List<dynamic>) {
        articles = articlesJson.map((json) => Article.fromJson(json)).toList();
        filterArticles();
      } else {
        throw Exception('Invalid articles data');
      }
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  void toggleSortOrder() {
    isDescendingOrder = !isDescendingOrder;
    fetchArticles();
  }

  void filterArticles() {
    filteredArticles = articles.where((article) {
      final titleMatches =
          article.titre.toLowerCase().contains(searchKeyword.toLowerCase());
      final summaryMatches =
          article.resume.toLowerCase().contains(searchKeyword.toLowerCase());
      return titleMatches || summaryMatches;
    }).toList();
    notifyListeners();
  }
}
