<?php include $this->resolve("partials/_header.php"); ?>

<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <form method="POST" class="grid grid-cols-1 gap-6">
        <?php include $this->resolve('partials/_csrf.php'); ?>
        <!-- Name -->
        <label class="block">
            <span class="text-gray-700">Employe Name</span>
            <input value="<?php echo e($employe['name']); ?>" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Aman khan" />
            <?php if (array_key_exists('name', $errors)) : ?>
                <div class="bg-gray-100 mt-2 text-red-500">
                    <?php echo e($errors['name'][0]); ?>
                </div>
            <?php endif; ?>
        </label>
        <!-- Email -->
        <label class="block">
            <span class="text-gray-700">Email</span>
            <input value="<?php echo e($employe['email']); ?>" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="jointyrost.0786@gmail.com" />
            <?php if (array_key_exists('email', $errors)) : ?>
                <div class="bg-gray-100 mt-2 text-red-500">
                    <?php echo e($errors['email'][0]); ?>
                </div>
            <?php endif; ?>
        </label>
        <!-- Age -->
        <label class="block">
            <span class="text-gray-700">Age</span>
            <input value="<?php echo e($employe['age']); ?>" name="age" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php if (array_key_exists('age', $errors)) : ?>
                <div class="bg-gray-100 mt-2 text-red-500">
                    <?php echo e($errors['age'][0]); ?>
                </div>
            <?php endif; ?>
        </label>
        <!-- Country -->
        <label class="block">
            <span class="text-gray-700">Country</span>
            <select name="country" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="India">India</option>
                <option value="Canada" <?php echo $employe['country'] === 'Canada' ? 'selected' : ''; ?>>Canada</option>
                <option value="Mexico" <?php echo $employe['country'] === 'Mexico' ? 'selected' : ''; ?>>Mexico</option>
                <option value="Invalid">Invalid Country</option>
            </select>
            <?php if (array_key_exists('country', $errors)) : ?>
                <div class="bg-gray-100 mt-2 text-red-500">
                    <?php echo e($errors['country'][0]); ?>
                </div>
            <?php endif; ?>
        </label>
        <!-- Social Media URL -->
        <label class="block">
            <span class="text-gray-700">Social Media URL</span>
            <input value="<?php echo e($employe['social_media_url']); ?>" name="socialMediaURL" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php if (array_key_exists('socialMediaURL', $errors)) : ?>
                <div class="bg-gray-100 mt-2 text-red-500">
                    <?php echo e($errors['socialMediaURL'][0]); ?>
                </div>
            <?php endif; ?>
        </label>
        <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
            Submit
        </button>
    </form>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>