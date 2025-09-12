
INSERT INTO Tutorials(tno, title, version, about, description, finalDesc) VALUES (2, 'Bloc', '1.21.4', 'Créer un bloc basic',
                                                                                  'Les blocs sont la base de Minecraft, dans ce tutoriel nous allons voir comment créer un bloc avec ',
                                                                                  'Cela nous donne un bloc tout rose');

------- Fabric

INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc1',
                                                            'La classe de base pour la création de bloc est <b>Block</b> qui possède un seul argument qu''on appelle Settings de la classe AbstractBlock !',
                                                            '//Création des Settings
.create() //Necessaire dans la creation des paramètres
.copy(AbstractBlock block) //Copie les paramètres d''un autre bloc (ex: .copy(Blocks.DIAMOND_BLOCK))

//Après la création des Settings
.strength(float hardness, float resistance)  //Pour la force du bloc, hardness le temps de casse pour le joueur et resistance pour la résistance au explosion par exemple
.strength(float hardness) //Fait exactement la même chose que ci dessus mais ne necessite qu''un paramètre, la résistance et elle appliqué par défaut
.requiresTool() //Le bloc doit être récupérer avec le bon outil (ex: Pioche pour la pierre)
.sounds(BlockSoundGroup soundGroup) //Définis le son du bloc par défaut c''est celui de la roche
.nonOpaque() //Définit le bloc comme transparent (La lumière passe à travers)
.noCollision() //Définit que le bloc n''a pas de collision (utile pour les plantes)
.breakInstantly() //Définit que le bloc se casse instant (ex: herbes ou torches)
.dropsLike(Block source) //Définit un drop d''un autre bloc à la place (ex : torche mural drop une torche)
.luminance(ToIntFunction<BlockState> luminance) //Définit la lumiére que le bloc emmet (ex: .luminance(state -> 15) pour la glowstone)', 2);

INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc2',
                                                            'Voici une création de bloc basique (tutorial est l''id du mod et example_block et l''id du block)',
                                                            'public class ModBlocks {

    //Create a new block
    public static final Block EXAMPLE_BLOCK = new Block(AbstractBlock.Settings.create().hardness(4.0f).registryKey(RegistryKey.of(RegistryKeys.BLOCK, Identifier.of("tutorial", "example_block"))));

    public static void initBlocks()
    {
        //Register the block
        Registry.register(Registries.BLOCK, Identifier.of("tutorial", "example_block"), EXAMPLE_BLOCK);
        Registry.register(Registries.ITEM, Identifier.of("tutorial", "example_block"), new BlockItem(EXAMPLE_BLOCK, new Item.Settings().useBlockPrefixedTranslationKey()
                .registryKey(RegistryKey.of(RegistryKeys.ITEM, Identifier.of("tutorial", "example_block")))));
    }
}', 2);

INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc3',
                                                            'Ne pas oublier d''initialiser l''enregistrement dans la classe principal, pour l''ajouter à une table creative on utilise ItemGroupEvents',
                                                            'public class TutorialMod implements ModInitializer {

    public static final String MOD_ID = "tutorial";

    public void onInitialize()
    {
            ModBlocks.initBlocks();
            ItemGroupEvents.modifyEntriesEvent(ItemGroups.BUILDING_BLOCKS).register(content -> {
                content.add(ModBlocks.EXAMPLE_BLOCK);
            });
    }
}',
                                                            2);
------- End Fabric

------- Forge



INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc1',
                                                            'La classe de base pour la création de bloc est <b>Block</b> qui possède un seul arguments qu''on appelle Properties de la classe BlockBehaviour !',
                                                            '//Création des Properties
.of() //Necessaire dans la creation des paramètres
.ofFullCopy(BlockBehaviour block) //Copie les paramètres d''un autre bloc (ex: .ofFullCopy(Blocks.DIAMOND_BLOCK))

//Après la création des Settings
.strength(float hardness, float resistance)  //Pour la force du bloc, hardness le temps de casse pour le joueur et resistance pour la résistance au explosion par exemple
.strength(float hardness) //Fait exactement la même chose que ci dessus mais ne necessite qu''un paramètre, la résistance et elle appliqué par défaut
.requiresCorrectToolForDrops() //Le bloc doit être récupérer avec le bon outil (ex: Pioche pour la pierre)
.sound(SoundType soundType) //Définis le son du bloc par défaut c''est celui de la roche
.dynamicShape() //Définit le bloc comme transparent (La lumière passe à travers)
.noCollision() //Définit que le bloc n''a pas de collision (utile pour les plantes)
.instabreak() //Définit que le bloc se casse instant (ex: herbes ou torches)
.overrideLootTable(Optional<ResourceKey<LootTable>> lootTable) //Définit un drop d''un autre bloc à la place (ex : torche mural drop une torche)
.lightLevel(ToIntFunction<BlockState> luminance) //Définit la lumiére que le bloc emmet (ex: .lightLevel(state -> 15) pour la glowstone)',
                                                            1);

INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc2',
                                                            'Voici une création de bloc basique (tutorial est l''id du mod et example_block et l''id du block)',
                                                            'public class ModBlocks
{
    public static final DeferredRegister<Block> BLOCKS = DeferredRegister.create(ForgeRegistries.BLOCKS, TutorialMod.MODID);
    public static final DeferredRegister<Item> ITEMS = DeferredRegister.create(ForgeRegistries.ITEMS, TutorialMod.MODID);

    public static final RegistryObject<Block> EXAMPLE_BLOCK = createBlock("example_block",
    ()-> new Block(BlockBehaviour.Properties.of().setId(ResourceKey.create(Registries.BLOCK,
    ResourceLocation.fromNamespaceAndPath(TutorialMod.MODID, "example_block")))));

    public static RegistryObject<Block> createBlock(String name, Supplier<Block> b)
    {
        RegistryObject<Block> block = BLOCKS.register(name, b);
        ITEMS.register(name, ()-> new BlockItem(block.get(), new Item.Properties().useBlockDescriptionPrefix()
        .setId(ResourceKey.create(Registries.ITEM, ResourceLocation.fromNamespaceAndPath(TutorialMod.MODID, name)))));
        return block;
    }
}', 1);

INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc3',
                                                            'Ne pas oublier d''initialiser l''enregistrement dans la classe principal, pour l''ajouter à une table creative on utilise BuildCreativeModeTabContentsEvent',
                                                            '@Mod(TutorialMod.MODID)
public class TutorialMod
{
    public static final String MODID = "tutorial";

    public TutorialMod(FMLJavaModLoadingContext context)
    {
        ModBlocks.BLOCKS.register(context.getModEventBus());
        ModBlocks.ITEMS.register(context.getModEventBus());
        context.getModEventBus().addListener(this::addCreative);
    }

    private void addCreative(BuildCreativeModeTabContentsEvent event)
    {
        if (event.getTabKey() == CreativeModeTabs.BUILDING_BLOCKS)
        {
            event.accept(ModBlocks.EXAMPLE_BLOCK.get());
        }
    }
}',
                                                            1);
-------

------- NeoForge

INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc1',
                                                            'La classe de base pour la création de bloc est <b>Block</b> qui possède un seul arguments qu''on appelle Properties de la classe BlockBehaviour !',
                                                            '//Création des Properties
.of() //Necessaire dans la creation des paramètres
.ofFullCopy(BlockBehaviour block) //Copie les paramètres d''un autre bloc (ex: .ofFullCopy(Blocks.DIAMOND_BLOCK))

//Après la création des Settings
.strength(float hardness, float resistance)  //Pour la force du bloc, hardness le temps de casse pour le joueur et resistance pour la résistance au explosion par exemple
.strength(float hardness) //Fait exactement la même chose que ci dessus mais ne nécessite qu''un paramètre, la résistance et elle appliqué par défaut
.requiresCorrectToolForDrops() //Le bloc doit être récupérer avec le bon outil (ex: Pioche pour la pierre)
.sound(SoundType soundType) //Définis le son du bloc par défaut c''est celui de la roche
.dynamicShape() //Définit le bloc comme transparent (La lumière passe à travers)
.noCollision() //Définit que le bloc n''a pas de collision (utile pour les plantes)
.instabreak() //Définit que le bloc se casse instant (ex: herbes ou torches)
.overrideLootTable(Optional<ResourceKey<LootTable>> lootTable) //Définit un drop d''un autre bloc à la place (ex : torche mural drop une torche)
.lightLevel(ToIntFunction<BlockState> luminance) //Définit la lumiére que le bloc emmet (ex: .lightLevel(state -> 15) pour la glowstone)',
                                                            3);

INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc2',
                                                            'Voici une création de bloc basique (tutorial est l''id du mod et example_block et l''id du block)',
                                                            'public class ModBlocks
{
    public static final DeferredRegister.Blocks BLOCKS = DeferredRegister.createBlocks(TutorialMod.MODID);
    public static final DeferredRegister.Items ITEMS = DeferredRegister.createItems(TutorialMod.MODID);

    public static final DeferredBlock<Block> EXAMPLE_BLOCK = createBlock("example_block", ()->
    new Block(BlockBehaviour.Properties.of().strength(4.0f).setId(ResourceKey.create(Registries.BLOCK,
    ResourceLocation.fromNamespaceAndPath(TutorialMod.MODID, "example_block")))));

    public static DeferredBlock<Block> createBlock(String name, Supplier<Block> b)
    {
        DeferredBlock<Block> block = BLOCKS.register(name, b);
        ITEMS.register(name, ()-> new BlockItem(block.get(), new Item.Properties().useBlockDescriptionPrefix()
        .setId(ResourceKey.create(Registries.ITEM, ResourceLocation.fromNamespaceAndPath(TutorialMod.MODID, name)))));
        return block;
    }
}', 3);

INSERT INTO Components(cno, description, code, lno) VALUES ('javabloc3',
                                                            'Ne pas oublier d''initialiser l''enregistrement dans la classe principal, pour l''ajouter à une table creative on utilise BuildCreativeModeTabContentsEvent',
                                                            '@Mod(TutorialMod.MODID)
public class TutorialMod
{
    public static final String MODID = "tutorial";

    public TutorialMod(IEventBus modEventBus)
    {
        ModBlocks.ITEMS.register(modEventBus);
        ModBlocks.BLOCKS.register(modEventBus);
        modEventBus.addListener(this::addCreative);
    }

    private void addCreative(BuildCreativeModeTabContentsEvent event)
    {
        if (event.getTabKey() == CreativeModeTabs.BUILDING_BLOCKS)
        {
            event.accept(ModBlocks.EXAMPLE_BLOCK.get());
        }
    }
}',
                                                            3);
-------

INSERT INTO Components(cno, description, code, lno) VALUES ('jsonbloc1',
                                                            'Ensuite viens le rendu du bloc, pour commencer créer ce fichier à cette emplacement "resources/assets/tutorial/blockstates/example_block.json" ce qui créera la blockstate',
                                                            '{
  "variants": {
    "": { "model": "tutorial:block/example_block" }
  }
}',
                                                            4);

INSERT INTO Components(cno, description, code, lno) VALUES ('jsonbloc2',
                                                            'Puis créer le models du bloc avec ces textures "resources/assets/tutorial/models/block/example_block.json"',
                                                            '{
  "parent": "block/cube_all",
  "textures": {
    "all": "tutorial:block/example_block"
  }
}',
                                                            4);

INSERT INTO Components(cno, description, code, lno) VALUES ('jsonbloc3',
                                                            'Après le models du bloc en tant qu''item : resources/assets/tutorial/items/example_block.json',
                                                            '{
  "model": {
    "type": "minecraft:model",
    "model": "tutorial:block/example_block"
  }
}',
                                                            4);

INSERT INTO Components(cno, description, code, lno) VALUES ('jsonbloc4',
                                                            'Pour que le bloc ai un nom normal il faut créer un fichier de language spécifique au mod (en_us est pris par défaut mais vous pouvez très bien créer une traduction française en renommant le fichier copier en fr_fr.json : "resources/assets/tutorial/lang/en_us.json"',
                                                            '{
  "block.tutorial.example_block": "Example Block"
}',
                                                            4);

INSERT INTO Components(cno, description, code, lno) VALUES ('texturebloc1',
                                                            'Assurez vous que la texture fasse une dimension de 16x16 : "resources/assets/tutorial/textures/block/example_block.png"',
                                                            'textures/example_block.png',
                                                            4);

INSERT INTO Components(cno, description, code, lno) VALUES ('imgbloc1',
                                                            'Bloc d''exemple rose dans un onglet créatif',
                                                            'textures/blockresult1.png',
                                                            4);


INSERT INTO Components(cno, description, code, lno) VALUES ('imgbloc2',
                                                            'Bloc d''exemple rose posé dans un monde plat',
                                                            'textures/blockresult2.png',
                                                            4);