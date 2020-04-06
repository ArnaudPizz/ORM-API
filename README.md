# ORM-API
1. Quel est l'intérêt de créer une API plutôt qu'une application classique ?
L'interêt d'utiliser une API plutôt qu'une application classique c'est tout d'abord qu'elle est utilisable par tout le monde dans le même format.

2. Résumez les étapes du mécanisme de sérialisation implémenté dans Symfony
Lorsque on sérialise, on normalise l’objet en tableau avant de le convertir dans un format (XML ou JSON par xemple).

3. Qu'est-ce qu'un groupe de sérialisation ? A quoi sert-il ?
Un groupe de serialisation est un groupe qui va nous permettre de choisir les propriétés d'un objet que l'on veut afficher .

4. Quelle est la différence entre la méthode PUT et la méthode PATCH ?
PUT peut permettre de vréer une ressource alors que PATCH ne peut peu que modifier une ressource deja existante.

5. Quels sont les différents types de relation entre entités pouvant être mis en place avec Doctrine ?
Les différentes relations entre entités sont : OneToOne ManyToOne OneToMany ManyToMany.

6. Qu'est-ce qu'un Trait en PHP et à quoi peut-il servir ?
Les traits permettent de réutiliser des méthodes dans des classes externes, contrairemtn a l'héritage basique de PHP.
