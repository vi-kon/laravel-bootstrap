<?php

namespace ViKon\Bootstrap;

use Collective\Html\HtmlBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;
use Illuminate\Support\MessageBag;

/**
 * Class FormBuilder
 *
 * @package ViKon\Bootstrap
 *
 * @author  Kovács Vince<vincekovacs@hotmail.com>
 */
class FormBuilder
{
    /** @type \Collective\Html\HtmlBuilder */
    protected $html;

    /** @type \Collective\Html\FormBuilder */
    protected $form;

    /** @type \Illuminate\Session\Store */
    protected $session;

    /**
     * FormBuilder constructor.
     *
     * @param \Collective\Html\HtmlBuilder $html
     * @param \Collective\Html\FormBuilder $form
     */
    public function __construct(HtmlBuilder $html, \Collective\Html\FormBuilder $form)
    {
        $this->html = $html;
        $this->form = $form;
    }

    /**
     * @param \Illuminate\Session\Store $session
     *
     * @return $this
     */
    public function setSessionStore(Store $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Create text input field
     *
     * @param string      $name
     * @param string|null $value
     * @param array       $options
     *
     * @return string
     */
    public function text($name, $value = null, array $options = [])
    {
        return $this->form->text($name,
                                 $value,
                                 $this->addFormControlClass($this->getFieldOptions($name, $options)));
    }

    /**
     * Create password field
     *
     * @param string $name
     * @param array  $options
     *
     * @return string
     */
    public function password($name, array $options = [])
    {
        return $this->form->password($name,
                                     $this->addFormControlClass($this->getFieldOptions($name, $options)));
    }

    /**
     * Create date input field
     *
     * @param string      $name
     * @param string|null $value
     * @param array       $options
     *
     * @return string
     */
    public function date($name, $value = null, array $options = [])
    {
        return $this->form->date($name,
            $value,
            $this->addFormControlClass($this->getFieldOptions($name, $options)));
    }

    /**
     * Create datetime input field
     *
     * @param string      $name
     * @param string|null $value
     * @param array       $options
     *
     * @return string
     */
    public function datetime($name, $value = null, array $options = [])
    {
        return $this->form->datetime($name,
            $value,
            $this->addFormControlClass($this->getFieldOptions($name, $options)));
    }

    /**
     * Create file field
     *
     * @param string $name
     * @param array  $options
     *
     * @return string
     */
    public function file($name, array $options = [])
    {
        return $this->form->file($name, $this->addFormControlClass($this->getFieldOptions($name, $options)));
    }

    /**
     * Create textarea
     *
     * @param string      $name
     * @param string|null $value
     * @param array       $options
     *
     * @return string
     */
    public function textarea($name, $value = null, array $options = [])
    {
        return $this->form->textarea($name,
                                     $value,
                                     $this->addFormControlClass($this->getFieldOptions($name, $options)));
    }

    /**
     * @param string     $name
     * @param array      $list
     * @param array|null $selected
     * @param array      $options
     *
     * @return string
     */
    public function select($name, array $list = [], $selected = null, array $options = [])
    {
        return $this->form->select($name,
                                   $list,
                                   $selected,
                                   $this->addFormControlClass($this->getFieldOptions($name, $options)));
    }

    /**
     * @param string     $name
     * @param string|int $value
     * @param bool|null  $checked
     * @param array      $options
     *
     * @return string
     */
    public function checkbox($name, $value = 1, $checked = null, array $options = [])
    {
        $field = $this->form->checkbox($name,
                                       $value,
                                       $checked,
                                       $this->getFieldOptions($name, $options));

        if ((bool)Arr::get($options, 'inline', false)) {
            return '<label class="checkbox-inline">' . $field . Arr::get($options, 'content', '') . '</label>';
        }

        return '<div class="checkbox"><label>' . $field . Arr::get($options, 'content', '') . '</label></div>';
    }

    /**
     * @param string     $name
     * @param string|int $value
     * @param bool|null  $checked
     * @param array      $options
     *
     * @return string
     */
    public function radio($name, $value = 1, $checked = null, array $options = [])
    {
        $field = $this->form->radio($name,
            $value,
            $checked,
            $this->getFieldOptions($name, $options));

        if ((bool)Arr::get($options, 'inline', false)) {
            return '<label class="radio-inline">' . $field . Arr::get($options, 'content', '') . '</label>';
        }

        return '<div class="radio"><label>' . $field . Arr::get($options, 'content', '') . '</label></div>';
    }

    /**
     * Create token input field
     *
     * @param string $name
     * @param string $url
     * @param null   $value
     * @param array  $options
     *
     * @return string
     */
    public function tokenInput($name, $url, $value = null, array $options = [])
    {
        $script = '<script type="text/javascript">
        (function ($, undefined) {
            var selector = \'#' . $this->getFieldId($name, $options) . '\';

            $(selector).tokenInput({
                ajax     : {
                    url : \'' . $url . '\',
                    data: {
                        _token: \'' . csrf_token() . '\'
                    },
                    loadByIdentifier: true
                },

                unique   : true,' .
                  (Arr::has($options, 'js.resultFormatterId')
                      ? 'resultFormat: $(\'#' . Arr::get($options, 'js.resultFormatterId') . '\').html(),'
                      : '') . '
                preloaded: ' . Arr::get($options, 'js.preloaded', new Collection())->toJson() . ',
                disabled : ' . (Arr::get($options, 'disabled', false) ? 'true' : 'false') . '
            });
        }(jQuery));
</script>';

        return $this->text($name, $value, $options) . $script;
    }

    public function groupText($name, $value = null, array $options = [])
    {
        return $this->wrapToGroup($name, $this->text($name, $value, $options), $options);
    }

    public function groupPassword($name, array $options = [])
    {
        return $this->wrapToGroup($name, $this->password($name, $options), $options);
    }

    public function groupFile($name, array $options = [])
    {
        return $this->wrapToGroup($name, $this->file($name, $options), $options);
    }

    public function groupTextarea($name, $value, array $options = [])
    {
        return $this->wrapToGroup($name, $this->textarea($name, $value, $options), $options);
    }

    public function groupSelect($name, array $list = [], $selected = null, array $options = [])
    {
        return $this->wrapToGroup($name, $this->select($name, $list, $selected, $options), $options);
    }

    public function groupCheckbox($name, $value = 1, $checked = null, array $options = [])
    {
        return $this->wrapToGroup($name, $this->checkbox($name, $value, $checked, $options), $options);
    }

    public function groupRadio($name, $value = 1, $checked = null, array $options = [])
    {
        return $this->wrapToGroup($name, $this->radio($name, $value, $checked, $options), $options);
    }

    public function groupTokenInput($name, $url, $value = null, array $options = [])
    {
        return $this->wrapToGroup($name, $this->tokenInput($name, $url, $value, $options), $options);
    }

    public function groupStatic($name, $text, array $options = [])
    {
        return $this->wrapToGroup($name, '<p class="form-control-static">' . $text . '</p>', $options);
    }

    public function wrapToGroup($name, $field, array $options = [])
    {
        $errors   = $this->session->get('errors', new MessageBag());
        $fieldId  = $this->getFieldId($name, $options);
        $key      = str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $name);
        $hasError = $errors->has($key);

        $output = '<div class="form-group form-group-' . $fieldId . ($hasError ? ' has-error' : '') . '">';

        if (Arr::has($options, 'label')) {
            $output .= $this->form->label($name, Arr::get($options, 'label'), [
                'for'   => $this->getFieldId($name, $options),
                'class' => 'control-label' . (Arr::get($options, 'vertical', false) === true
                        ? ''
                        : ' col-sm-' . Arr::get($options, 'labelSize', 3)),
            ]);
        };

        // Field holding div
        if (Arr::get($options, 'vertical', false) === true) {
            $output .= '<div>';
        } else {
            $output .= '<div class="' .
                       (!Arr::has($options, 'label')
                           ? 'col-sm-offset-' . Arr::get($options, 'labelSize', 3) . ' '
                           : '') .
                       'col-sm-' . (12 - Arr::get($options, 'labelSize', 3)) . '">';
        }

        $output .= '<div class="form-group-field">' . $field . '</div>';

        if ($hasError) {
            $output .= '<div class="help-block error-block">' . $errors->first($key) . '</div>';
        }

        if (Arr::has($options, 'help') && trim(Arr::get($options, 'help', '')) !== '') {
            $output .= '<div class="help-block text-justify">' . Arr::get($options, 'help') . '</div>';
        }

        $output .= '</div></div>';

        return $output;
    }

    /**
     * Get field options
     *
     * @param string $name
     * @param array  $options
     *
     * @return mixed
     */
    protected function getFieldOptions($name, array $options = [])
    {
        $fieldOptions = Arr::get($options, 'field', []);

        if ($this->isFieldDisabled($options)) {
            $fieldOptions['disabled'] = 'disabled';
        }

        $fieldOptions['id'] = $this->getFieldId($name, $options);

        return $fieldOptions;
    }

    /**
     * Add form-control class to field options
     *
     * @param array $fieldOptions
     *
     * @return array
     */
    protected function addFormControlClass(array $fieldOptions = [])
    {
        $class = Arr::get($fieldOptions, 'class', 'form-control');
        if (strpos($class, 'form-control') === false) {
            $class .= ' form-control';
        }
        $fieldOptions['class'] = $class;

        return $fieldOptions;
    }

    /**
     * Check if field is disabled or not
     *
     * @param array $options
     *
     * @return bool
     */
    protected function isFieldDisabled(array $options = [])
    {
        return Arr::get($options, 'disabled', false) === true;
    }

    /**
     * Get field id
     *
     * @param string $name
     * @param array  $options
     *
     * @return mixed|string
     */
    protected function getFieldId($name, array $options = [])
    {
        if (Arr::has($options, 'field.id')) {
            return Arr::get($options, 'field.id');
        }

        return 'field-' . str_replace('_', '-', $name);
    }
}