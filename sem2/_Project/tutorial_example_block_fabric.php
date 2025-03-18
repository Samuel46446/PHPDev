<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft Modding Tutorial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
   <style>
       h1{
           color: #5CEB95;
           margin-left: 20px;
       }
       h2{
           color: #1FC946;
           margin-left: 20px;
       }
       .pInUl{
           color: #F525E3;
           margin-left: 80px;
       }
       p{
           color: #F525E3;
           margin-left: 40px;
       }
       body {
                background-color: rgb(17, 17, 17);
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
            }
            pre {
                background-color: rgb(17, 17, 17);
                padding: 10px;
                border-radius: 5px;
                overflow-x: auto;
               display: inline-block; /* Ajuste la largeur au contenu */
               max-width: 100%; /* Empêche le dépassement */
               border: 1px solid rgb(17, 17, 17);
               white-space: pre-wrap; /* Permet les retours à la ligne si besoin */
            }
            .language-java {
                border-radius: 10px;
            }
            .language-json {
                border-radius: 10px;
            }
   </style>
</head>
<body>
    <header>
        <h1>Créé un bloc basic</h1>
        <p>Les blocs son la base de Minecraft, dans ce tutoriel nous allons voir comment créer un bloc pour la fabric api.</p>

        <ul>
            <h2>Code de base du bloc</h2>

            <p>La classe de base pour la création de bloc est <b>Block</b> qui posséde
                un seul arguments qu'on appelle <b>Settings</b> de la classe <b>AbstractBlock</b> !</p>
                <p><pre><code class="language-java">//Création des Settings
.of() //Necessaire dans la creation des paramètres
.copy(AbstractBlock block) //Copie les paramètres d'un autre bloc (ex: .copy(Blocks.DIAMOND_BLOCK))

//Après la création des Settings
.strength(float hardness, float resistance)  //Pour la force du bloc, hardness le temps de casse pour le joueur et resistance pour la résistance au explosion par exemple
.strength(float hardness) //Fait exactement la même chose que ci dessus mais ne necessite qu'un paramètre, la résistance et elle appliqué par défaut
.requiresTool() //Le bloc doit être récupérer avec le bon outil (ex: Pioche pour la pierre)
.sounds(BlockSoundGroup soundGroup) //Définis le son du bloc par défaut c'est celui de la roche
.nonOpaque() //Définit le bloc comme transparent (La lumière passe à travers)
.noCollision() //Définit que le bloc n'a pas de collision (utile pour les plantes)
.breakInstantly() //Définit que le bloc se casse instant (ex: herbes ou torches)
.dropsLike(Block source) //Définit un drop d'un autre bloc à la place (ex : torche mural drop une torche)
.luminance(ToIntFunction<BlockState> luminance) //Définit la lumiére que le bloc emmet (ex: .luminance(state -> 15) pour la glowstone)</code></pre></li>
            <pre><code class="language-java">
public class ModBlocks {

    //Create a new block
    public static final Block EXAMPLE_BLOCK = new Block(AbstractBlock.Settings.of().hardness(4.0f).registryKey(RessourceKey.of(RessourceKeys.BLOCKS, Identifier.of("tutorial", "example_block"))));

    public static void initBlocks()
    {
        //Register the block
        Registry.register(Registries.BLOCK, Identifier.of("tutorial", "example_block"), EXAMPLE_BLOCK);
        Registry.register(Registries.ITEM, Identifier.of("tutorial", "example_block"), new BlockItem(EXAMPLE_BLOCK, new Item.Settings().useBlockPrefixedTranslationKey()
                .registryKey(RessourceKey.of(RessourceKeys.ITEMS, Identifier.of("tutorial", "example_block"))));
    }
}
        </code></pre>
        <pre><code class="language-java">
public class TutorialMod implements ModInitializer {

    public static final String MOD_ID = "tutorial";

    public void onInitialize()
    {
            ModBlocks.initBlocks();
            ItemGroupEvents.modifyEntriesEvent(ItemGroup.TAB_BUILDING_BLOCKS).register(content -> {
                content.add(ModBlocks.EXAMPLE_BLOCK);
            });
    }
}
        </code></pre>
            <p>Ne pas oublier de l'enregistrer dans la classe principale</p>


            <h2>blockstates/example_block.json</h2>
        <pre><code class="language-json">
{
  "variants": {
    "": { "model": "tutorial:block/example_block" }
  }
}
        </code></pre>
        <h2>models/block/example_block.json</h2>
        <pre><code class="language-json">
{
  "parent": "block/cube_all",
  "textures": {
    "all": "tutorial:block/example_block"
  }
}
        </code></pre>
        <h2>models/item/example_block.json</h2>
        <pre><code class="language-json">
{
  "parent": "tutorial:block/example_block"
}
        </code></pre>
        <h2>resources/assets/tutorial/textures/block/example_block.png</h2>
        <img src="textures/example_block.png" alt="example_block" style="image-rendering: pixelated; width: 200px; height: 200px;">
        </>
        <div class="container">
            <div id="branding">
                <h1>Autres :</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <footer>
        <p>&copy; 2023 Minecraft Modding Tutorial. All rights reserved.</p>
    </footer>
</body>
</html></footer></ul></div></ul></nav></div></body></html>