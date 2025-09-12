
INSERT INTO Tutorials(tno, title, version, about, description, finalDesc) VALUES (3, 'Item', '1.21.4', 'Créé un item basic',
'Les items permettent de faire toute sorte de chose comme des armures, nourriture et outils, mais pour ce tutoriel nous allons voir comment créer un item basic avec ',
'Cela nous donne un diamant tout rose');

--- Neoforge

INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem1',
                                                            'La classe de base pour la création d''item est <b>Item</b> qui possède un seul arguments qu''on appelle Properties de la classe Item !',
                                                            '//Les Properties sont instancié comme ci
new Item(new Item.Properties())
//Après la création des Properties
.stacksTo(int maxStackSize)  //Pour le nombre max d''item dans le même slot (ex: les oeufs sont stackable par 16), par défaut tous items à un stack max de 64
.craftRemainder(Item craftingRemainingItem) //Permet de récupérer un item lors du craft, un conteneur (ex: seau de lait lors d''une création de gateau redonne les seaux)
.rarity(Rarity rarity) //Définis la rareté de l''item pour lui appliquer une couleur particulière (ex: la pomme d''or enchanté et epic et s''affiche en violet)
.food(FoodProperties food) //Définit l''item comme une nourriture avec ces paramètres
.fireResistant() //Définit la résistance au feu de l''item, comme les items en netherite, ils ne seront pas détruit par la lave
.durability(int maxDamage) //Définit la durabilité de l''item, comme pour un briquet, une armure ou un outil
.repairable(Item repairItem) //Définit l''item qui répare notre item, si celui à une durabilité
.equippable(EquipmentSlot slot) //Définit si l''item peut être équiper (ex: une armure)
.useBlockDescriptionPrefix() //Définit si l''item doit t''utiliser le prefix de traduction de bloc, ceci est utile pour les BlockItem',
                                                            3);

INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem2',
                                                            'Voici une création d''item basique (tutorial est l''id du mod et example_item et l''id de l''item)',
                                                            'public class ModItems
{
    public static final DeferredRegister.Items ITEMS = DeferredRegister.createItems(TutorialMod.MODID);

    public static final DeferredItem<Item> EXAMPLE_ITEM = ITEMS.register("example_item", ()->
    new Item(new Item.Properties().stacksTo(16).fireResistant().setId(ResourceKey.create(
    Registries.ITEM, ResourceLocation.fromNamespaceAndPath(TutorialMod.MODID, "example_item")))));
}', 3);

INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem3',
                                                            'Ne pas oublier d''initialiser l''enregistrement dans la classe principal, pour l''ajouter à une table creative on utilise BuildCreativeModeTabContentsEvent',
                                                            '@Mod(TutorialMod.MODID)
public class TutorialMod
{
    public static final String MODID = "tutorial";

    public TutorialMod(IEventBus modEventBus)
    {
        ModItems.ITEMS.register(modEventBus);
        modEventBus.addListener(this::addCreative);
    }

    private void addCreative(BuildCreativeModeTabContentsEvent event)
    {
        if (event.getTabKey() == CreativeModeTabs.INGREDIENTS)
        {
            event.accept(ModItems.EXAMPLE_ITEM.get());
        }
    }
}',
                                                            3);
---

--- Forge
INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem1',
                                                            'La classe de base pour la création d''item est <b>Item</b> qui possède un seul arguments qu''on appelle Properties de la classe Item !',
                                                            '//Les Properties sont instancié comme ci
new Item(new Item.Properties())
//Après la création des Properties
.stacksTo(int maxStackSize)  //Pour le nombre max d''item dans le même slot (ex: les oeufs sont stackable par 16), par défaut tous items à un stack max de 64
.craftRemainder(Item craftingRemainingItem) //Permet de récupérer un item lors du craft, un conteneur (ex: seau de lait lors d''une création de gateau redonne les seaux)
.rarity(Rarity rarity) //Définis la rareté de l''item pour lui appliquer une couleur particulière (ex: la pomme d''or enchanté et epic et s''affiche en violet)
.food(FoodProperties food) //Définit l''item comme une nourriture avec ces paramètres
.fireResistant() //Définit la résistance au feu de l''item, comme les items en netherite, ils ne seront pas détruit par la lave
.durability(int maxDamage) //Définit la durabilité de l''item, comme pour un briquet, une armure ou un outil
.repairable(Item repairItem) //Définit l''item qui répare notre item, si celui à une durabilité
.equippable(EquipmentSlot slot) //Définit si l''item peut être équiper (ex: une armure)
.useBlockDescriptionPrefix() //Définit si l''item doit t''utiliser le prefix de traduction de bloc, ceci est utile pour les BlockItem',
                                                            1);

INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem2',
                                                            'Voici une création d''item basique (tutorial est l''id du mod et example_item et l''id de l''item)',
                                                            'public class ModItems
{
    public static final DeferredRegister<Item> ITEMS = DeferredRegister.create(ForgeRegistries.ITEMS, TutorialMod.MODID);

    public static final RegistryObject<Item> EXAMPLE_ITEM = ITEMS.register("example_item", ()->
            new Item(new Item.Properties().stacksTo(16).fireResistant().setId(ResourceKey.create(
                    Registries.ITEM, ResourceLocation.fromNamespaceAndPath(TutorialMod.MODID, "example_item")))));
}', 1);

INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem3',
                                                            'Ne pas oublier d''initialiser l''enregistrement dans la classe principal, pour l''ajouter à une table creative on utilise BuildCreativeModeTabContentsEvent',
                                                            '@Mod(TutorialMod.MODID)
public class TutorialMod
{
    public static final String MODID = "tutorial";

    public TutorialMod(FMLJavaModLoadingContext context)
    {
        ModItems.ITEMS.register(context.getModEventBus());
        context.getModEventBus().addListener(this::addCreative);
    }

    private void addCreative(BuildCreativeModeTabContentsEvent event)
    {
        if (event.getTabKey() == CreativeModeTabs.INGREDIENTS)
        {
            event.accept(ModItems.EXAMPLE_ITEM.get());
        }
    }
}',
                                                            1);
---

--- Fabric

INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem1',
                                                            'La classe de base pour la création d''item est <b>Item</b> qui possède un seul arguments qu''on appelle Settings de la classe Item !',
                                                            '//Les Settings sont instancié comme ci
new Item(new Item.Settings())
//Après la création des Properties
.maxCount(int maxStackSize)  //Pour le nombre max d''item dans le même slot (ex: les oeufs sont stackable par 16), par défaut tous items à un stack max de 64
.recipeRemainder(Item recipeRemainder) //Permet de récupérer un item lors du craft, un conteneur (ex: seau de lait lors d''une création de gateau redonne les seaux)
.rarity(Rarity rarity) //Définis la rareté de l''item pour lui appliquer une couleur particulière (ex: la pomme d''or enchanté et epic et s''affiche en violet)
.food(FoodComponent food) //Définit l''item comme une nourriture avec ces paramètres
.fireproof() //Définit la résistance au feu de l''item, comme les items en netherite, ils ne seront pas détruit par la lave
.maxDamage(int maxDamage) //Définit la durabilité de l''item, comme pour un briquet, une armure ou un outil
.repairable(Item repairItem) //Définit l''item qui répare notre item, si celui à une durabilité
.equippable(EquipmentSlot slot) //Définit si l''item peut être équiper (ex: une armure)
.useBlockPrefixedTranslationKey() //Définit si l''item doit t''utiliser le prefix de traduction de bloc, ceci est utile pour les BlockItem',
                                                            2);

INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem2',
                                                            'Voici une création d''item basique (tutorial est l''id du mod et example_item et l''id de l''item)',
                                                            'public class ModItems {

    public static final Item EXAMPLE_ITEM = new Item(new Item.Settings().maxCount(16).fireproof()
    .registryKey(RegistryKey.of(RegistryKeys.ITEM, Identifier.of(TutorialMod.MODID, "example_item"))));

    public static void initItems() {
        //Register item
        Registry.register(Registries.ITEM, Identifier.of(TutorialMod.MODID, "example_item"), EXAMPLE_ITEM);
    }
}', 2);

INSERT INTO Components(cno, description, code, lno) VALUES ('javaitem3',
                                                            'Ne pas oublier d''initialiser l''enregistrement dans la classe principal, pour l''ajouter à une table creative on utilise ItemGroupEvents',
                                                            'public class TutorialMod implements ModInitializer {

	public static final String MODID = "tutorial";

	public void onInitialize() {
		ModItems.initItems();
		ItemGroupEvents.modifyEntriesEvent(ItemGroups.INGREDIENTS).register(content -> {
			content.add(ModItems.EXAMPLE_ITEM);
		});
	}
}',
                                                            2);

---

--- MC
INSERT INTO Components(cno, description, code, lno) VALUES ('jsonitem1',
                                                            'Ensuite viens le rendu de l''item, en commençant par le model à cette emplacement "resources/assets/tutorial/models/item/example_item.json"',
                                                            '{
  "parent": "minecraft:item/generated",
  "textures": {
    "layer0": "tutorial:item/example_item"
  }
}',
                                                            4);

INSERT INTO Components(cno, description, code, lno) VALUES ('jsonitem2',
                                                            'Puis créer ce fichiers : "resources/assets/tutorial/items/example_item.json"',
                                                            '{
  "model": {
    "type": "minecraft:model",
    "model": "tutorial:item/example_item"
  }
}',
                                                            4);


INSERT INTO Components(cno, description, code, lno) VALUES ('jsonitem3',
                                                            'Comme pour les blocs il faut ajouter une traduction a l''item pour qu''il ai un nom normal : "resources/assets/tutorial/lang/en_us.json"',
                                                            '{
  "block.tutorial.example_block": "Example Block",
  "item.tutorial.example_item": "Example Item"
}',
                                                            4);

INSERT INTO Components(cno, description, code, lno) VALUES ('textureitem1',
                                                            'Assurez vous comme pour les blocs que la texture fasse une dimension de 16x16 : "resources/assets/tutorial/textures/item/example_item.png"',
                                                            'textures/example_item.png',
                                                            4);

INSERT INTO Components(cno, description, code, lno) VALUES ('imgitem1',
                                                            'Item d''exemple rose dans un onglet créatif',
                                                            'textures/itemresult1.png',
                                                            4);


INSERT INTO Components(cno, description, code, lno) VALUES ('imgitem2',
                                                            'Item d''exemple rose tenu par un joueur',
                                                            'textures/itemresult2.png',
                                                            4);
---